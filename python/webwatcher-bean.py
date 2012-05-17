import urllib2
import re
from BeautifulSoup import BeautifulSoup


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

# User inputs URL
page = urllib2.urlopen("http://labor.ny.gov/app/warn/")

# Scrape URL, all of it
soup = BeautifulSoup(page)

table = soup.findAll('table')[0]

# The table is composed of ~89 rows each of which have one column. Dumb.
cells = table.findAll('td')

objs = []
for cell in cells:
    objs.append({
        'title': cell.findAll('strong')[0].text,
        # TODO -- add more attributes here, then use that PyRSS2Gen module to
        # make it rssified. No need for diffs.
    })

import pprint
pprint.pprint(objs)

print "the last item:"
print cells[0]
