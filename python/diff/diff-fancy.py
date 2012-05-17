import urllib2
import re
from BeautifulSoup import BeautifulSoup
from htmltreediff import diff
from kitchen.text.converters import to_unicode


f1 = open('travel.html', 'rw')

v1 = f1.read()

#def scrape(url=None, keywords=[], frequency=None, email=None):
# User inputs URL
#page = urllib2.urlopen("http://labor.ny.gov/app/warn/")
page = urllib2.urlopen("http://travel.state.gov/travel/cis_pa_tw/tw/tw_1764.html")


# Scrape URL, all of it
soup = BeautifulSoup(page)

# Find keywords
#warns_nyc = soup.findAll(text=re.compile("New York City"))
warns_travel = soup.findAll(text=re.compile("Lebanon"))


print diff(to_unicode(v1), to_unicode(page), pretty=True)


f1.close()
