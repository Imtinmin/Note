#-*-coding=utf-8 -*-
from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, BooleanField, SubmitField
from wtforms.validators import DataRequired,Email

class RegisterForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired()]) #此验证器将会检测field是否输入了数值，实际上是进行了if field.data操作。并且，如数数据是一个字符串，那么只包含空格的字符串将会被认为是False。
    confirm = PasswordField('Repeat Password')
    email = StringField('Email', validators=[Email()])
    submit = SubmitField('register')

class LoginForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired()])
    remember_me = BooleanField('Remember Me')
    submit = SubmitField('login')


class Remember(FlaskForm):
	oldpassword = StringField('Password',validators=[DataRequired()])
	newpassword = StringField('Oldpassword',validators=[DataRequired()])

