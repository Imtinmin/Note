import os

class Config(object):
    SECRET_KEY = os.environ.get('SECRET_KEY') or 'tinmin'
    SQLALCHEMY_DATABASE_URI = 'mysql+pymysql://root:root@localhost:3306/test'
