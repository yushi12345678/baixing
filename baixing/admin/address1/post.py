import sys 
import json 
import requests
import operator
from math import *

#添加数据到云存储中（名字，地点）
def addData(name,address):
    url = 'http://yuntuapi.amap.com/datamanage/data/create'
    tableid = '5c0fb1e6305a2a1c2ab5e662'
    key='615723f2a0fcc98f0169c6063c25e647'
    loctype="2"
    data={"_name":name,"_address":address}
    data=json.dumps(data)
    postdata={
        'tableid':tableid,
        'key':key,
        'loctype':loctype,
        'data':data
    }
    req = requests.post(url,data=postdata)
    content = req.json()
    return content

#更新数据到云存储中（id,名字，地点）
def updateData(id,name,address):
    url = 'https://yuntuapi.amap.com/datamanage/data/update'
    tableid = '5c0fb1e6305a2a1c2ab5e662'
    key='615723f2a0fcc98f0169c6063c25e647'
    loctype="2"
    data={"_id":id,"_name":name,"_address":address}
    data=json.dumps(data)
    postdata={
        'tableid':tableid,
        'key':key,
        'loctype':loctype,
        'data':data
    }
    req = requests.post(url,data=postdata)
    content = req.json()
    return content

#删除数据到云存储中（ids）
def deleteData(ids):
    url = 'https://yuntuapi.amap.com/datamanage/data/delete'
    tableid = '5c0fb1e6305a2a1c2ab5e662'
    key='615723f2a0fcc98f0169c6063c25e647'
    postdata={
        'tableid':tableid,
        'key':key,
        'ids':ids
    }
    print(postdata)
    req = requests.post(url,data=postdata)
    content = req.json()
    return content

#云图检索（关键字）
def http_get(keywords):
    url = 'http://yuntuapi.amap.com/datasearch/local?'
    #云图存储tableid
    tableid = '5c0fb1e6305a2a1c2ab5e662'
    #检索城市
    city= '吉林市'
    #过滤条件
    filter=''
    #创建应用key
    key='615723f2a0fcc98f0169c6063c25e647'
    url2 = url+'tableid='+tableid+"&city="+city+"&keywords="+keywords+"&filter="+filter+"&key="+key
    req = requests.get(url2)
    content = req.json()
    #返回查询到地点数据（json）
    return content

#根据经度纬度计算距离
def geoDistance(lng1,lat1,lng2,lat2):
    lng1, lat1, lng2, lat2 = map(radians, [lng1, lat1, lng2, lat2])
    dlon=lng2-lng1
    dlat=lat2-lat1
    a=sin(dlat/2)**2 + cos(lat1) * cos(lat2) * sin(dlon/2)**2 
    dis=2*asin(sqrt(a))*6371*1000
    return dis

#解析查询地点数据json计算距离打包返回getData(我的位置,与我距离点位置)
def getData(myplace,place,distance):
    data1=http_get(place)
    data2=http_get(myplace)
    content=[]
    if (data1['info']=="OK")&(data2['info']=="OK"):
        i = 0
        count=int(data1['count'])
        while i<count:
            where=data1['datas'][i]['_address']
            data3=data1['datas'][i]['_location'].split(',')
            data4=data2['datas'][0]['_location'].split(',')
            s=geoDistance(float(data3[0]),float(data3[1]),float(data4[0]),float(data4[1]))
            if int(s)>int(distance):
                i = i + 1
                continue
            contents={}
            contents['_id']=i 
            contents['_address']=where
            contents['_meter']=int(s)
            content.append(contents)
            i = i + 1
        content_x = sorted(content, key=operator.itemgetter('_meter'))
        content_data={
            'info':'ok',
            'data':content_x
        }
        #返回数据转换类型
        #content_data=json.dumps(content_data)
        return content_data     
    else:
        content_data={
            'info':'error',
        }
        return content_data
params = sys.argv[1:] #即为获取到的PHP传入python的入口参数
a=addData(params[0],params[1])
print(a);




