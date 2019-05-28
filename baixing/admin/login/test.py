import urllib.request
import json


data = {
    'user': 'admin',
    'pwd': 'admin'
}
values = urllib.parse.urlencode(data).encode(encoding='UTF8')
headers = {'Content-Type': 'application/json'}
print(data)
print(values)
print(json.dumps(data))
print(json.dumps(data).encode())
request = urllib.request.Request(
    url='http://localhost/baixing/admin/login/login.php', headers=headers, data=json.dumps(data).encode())
response = urllib.request.urlopen(request)
print(response)
