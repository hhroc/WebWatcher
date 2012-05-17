from htmltreediff import diff
from kitchen.text.converters import to_unicode


f1 = open('test1.html', 'r')
f2 = open('test2.html', 'r')


v1 = f1.read()
v2 = f2.read()

print diff(to_unicode(v1), to_unicode(v2), pretty=True)


f1.close()
f2.close()
