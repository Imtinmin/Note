#-*-coding=utf-8 -*-

# __author__ = "tinmin"

from flask import Flask
from flask import request
from flask import config
import sys
from flask import render_template_string,url_for
app = Flask(__name__)
'''attr = getattr(app, '__name__', getattr(app.__class__, '__name__'))
print attr
modname = getattr(app, '__module__',getattr(app.__class__, '__module__'))
mod = sys.modules.get(modname)
b = getattr(mod, '__file__', None)'''


app.config['SECRET_KEY'] = "flag{SSTI_123456}"
@app.route('/')
def hello_world():
    return 'Hello World!'

@app.errorhandler(404)
def page_not_found(e):
    template = '''
{%% block body %%}
    <div class="center-content error">
        <h1>Oops! That page doesn't exist.</h1>
        <h3>%s</h3>
    </div> 
{%% endblock %%}
''' % (request.url)
    return render_template_string(template), 404

if __name__ == '__main__':
    app.run(host='0.0.0.0')