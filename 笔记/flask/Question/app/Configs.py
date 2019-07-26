from app import app
from flask import config

class Config:
	app.config['SECRET_KEY'] = 't1n3in'
	app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:root@localhost:3306/flask'
