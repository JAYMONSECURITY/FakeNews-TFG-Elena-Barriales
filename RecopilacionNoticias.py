import requests
from html.parser import HTMLParser  

# URL DE LA PÁGINA DE POLITIFACT
initialURL = 'https://www.politifact.com/factchecks/list/?page='

#* DESCOMENTAR LA LINEA DE CODIGO DEL CANDIDATO QUE SE QUIERA OBTENER LAS FAKE NEWS *
#candidate = '&speaker=donald-trump' 
candidate = '&speaker=joe-biden' 

#* SOBREESCRITURA DE MÉTODOS *
class MyHTMLParser(HTMLParser):
    
    article = False
    donde = False
    enlace = False
    enlace2 = False
    f=""
    linea = ""
    
    def handle_starttag(self, tag, attrs):
        if tag=='article':
            for attr in attrs:
                if attr[1] != 'm-textblock' and attr[1] != 'o-listicle__content':
                    self.article = True
                    # print('Comienza articulo')
                    # print(f'Calificacion:{attr[1]}')
                    self.linea = self.linea + attr[1] + ';'
        
        if tag=='div' and self.article:
            for attr in attrs:
                if attr[1] == 'm-statement__desc':
                    self.donde = True
                elif attr[1] == 'm-statement__quote':
                    self.enlace = True  
                       
        elif tag=='a'and self.enlace and self.article:
           for attr in attrs:
               if '/fact' in attr[1]:
                   self.linea = self.linea + attr[1]+";"
                   # print(f'Enlace:{attr[1]}')
                   self.enlace2=True
                
    def handle_data(self, data):
        if self.donde and self.article:
            cadena=data.strip('\n')
            # print(f'Donde:{cadena}')
            self.linea = self.linea + cadena +";"
            self.donde = False
        elif self.enlace and self.enlace2 and self.article:
            cadena = data.strip('\n')
            #print(f'Contenido:{cadena}')
            self.enlace = False
            self.enlace2 = False
            self.linea = self.linea + cadena + ";"

   
    def handle_endtag(self, tag):
        if self.article and tag=='article':
            print(f'{self.linea}')
            self.article = False
            self.f = self.f + self.linea + '\n'
            self.linea=""

# * CAMBIAR filename.txt por el nombre que se quiera *
fichero = open('fileBiden.txt', 'a')

#* EN "range (1,Y)" cambiar la Y para poner la última página *
for i in range (1,5):
  print(f'Página: {i}')
  html = requests.get(initialURL+str(i)+candidate)
  parser = MyHTMLParser()
  parser.feed(html.content.decode())  
  fichero.write(parser.f)
fichero.close()
    