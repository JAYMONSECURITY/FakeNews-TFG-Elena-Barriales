from bs4 import BeautifulSoup
import pandas as pd
import requests
import urllib.request
import time

authors = []
dates = []
statements = []
sources = []
targets = []
pepes = []
#siguientes = []


def scrape_website(page_number):
    page_num = str(page_number)
   # URL = 'https://www.politifact.com/factchecks/list/?speaker=joe-biden&page='+page_num
    URL = 'https://www.politifact.com/factchecks/list/?speaker=donald-trump&page='+page_num
    webpage = requests.get(URL)
    soup = BeautifulSoup(webpage.text, 'html.parser')
    
    #Location info
    statement_footer = soup.find_all('footer', attrs={'class':'m-statement__footer'})#Location data
    statement_name = soup.find_all('div', attrs={'class':'m-statement__meta'})#Location candidate
    statement_quote = soup.find_all('div', attrs={'class':'m-statement__quote'})#Location statement
    statement_fuente = soup.find_all('div', attrs={'class':'m-statement__desc'}) #Location FUENTE
    target = soup.find_all('div', attrs={'class':'m-statement__meter'}) #Location target score card clasificacion

    #siguiente = soup.find_all('div', attrs={'class':'m-statement__meta'}) #Location source

    #Loop statement footer data
    for i in statement_footer:
        link1 = i.text.strip()
        name_and_date = link1.split()
        first_name = name_and_date[1]
        last_name = name_and_date[2]
        full_name = first_name + ' ' + last_name
        month = name_and_date[4]
        day = name_and_date[5]
        year = name_and_date[6]
        date = month+' '+day+' '+year
        dates.append(date)
        #Loop statement desc data source
    
    for i in statement_fuente:
            linku = i.text.strip()
            medio = linku.split()
            mediodifa = medio[4]
            sources.append(medio)
      #Loop statement quote
    for i in statement_name:
        link1 = i.find_all('a')
        statement_texto = link1[0].text.strip()
        pepes.append(statement_texto)
        
        #Loop statement quote
    for i in statement_quote:
        link2 = i.find_all('a')
        statement_text = link2[0].text.strip()
        statements.append(statement_text)
            
        #lopp target
    for i in target:
        link4 = i.find('div', attrs={'class':'c-image'}).find('img').get('alt')
        targets.append(link4)

#loop n-1 webpage(s) scrape data  32pag Trump   8 Biden
n = 32
for i in range(1, n):
    scrape_website(i)

#Create dataframe
data = pd.DataFrame(columns = ['Candidato', 'Fecha' , 'Fuente', 'Contenido', 'Clasificacion'])
data['Candidato'] = pepes
data['Fecha'] = dates
data['Contenido'] = statements
data['Fuente'] = sources
data['Clasificacion'] = targets
#Show data
data

#STORE in CSV File
data.to_excel('Political_fact_checker.xls')

