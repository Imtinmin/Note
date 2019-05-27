# -*- encoding: utf-8 -*-
#written in python 2.7
# Librarys
from flask import Flask, request
from urllib import unquote,quote

__author__ = 'tinmin'
# Variables
app = Flask(__name__)

# Settings
app.config['DEBUG'] = True
app.config['SECRET_KEY'] = 'secret'


# Views
@app.route('/', methods=('GET', 'POST'))
def index():
    sign_str = ''
    a = request.environ['QUERY_STRING']
    ticket = request.args.get('ticket')
    params_list = []
    flag = ''
    for item in a.split('&'):
        k, v = item.split('=')
        params_list.append((k, v))
    ida = request.args.get('id')

    for item in params_list:
       if item[0] == 'ticket':
            params_list.remove(item)
    for item in params_list:
        sign_str = sign_str + unquote(item[0]) + unquote(item[1])
        print quote(sign_str)

    print quote(sign_str)
    #print sign_str

    return quote(sign_str)+"\n"+ticket



# Run
if __name__ == '__main__':
    app.run()


#http://117.51.147.155:5050/ctf/api/remove_robot?id=61&ticket=85d9522e9427602c15afe32ba4b1b1d8