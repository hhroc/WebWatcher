import urllib2
import re
import sqlite3
from BeautifulSoup import BeautifulSoup
import sqlalchemy

"""
User inputs URL
User inputs email
User inputs keyword
User provides Frequency?

Scrape URL, all of it
Find keywords
save v1

When freq = x
Scrape URL
Find keywords
save v2

diff v1 v2

send message with the diff
"""

#def scrape(url=None, keywords=[], frequency=None, email=None):
# User inputs URL
#page = urllib2.urlopen("http://labor.ny.gov/app/warn/")
page = urllib2.urlopen("http://travel.state.gov/travel/cis_pa_tw/tw/tw_1764.html")


# Scrape URL, all of it
soup = BeautifulSoup(page)

# Find keywords
#warns_nyc = soup.findAll(text=re.compile("New York City"))
warns_travel = soup.findAll(text=re.compile("Lebanon"))


#for warn in warns_nyc:
#    print warn

for warn in warns_travel:
    print warn
