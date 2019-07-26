from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, BooleanField, SubmitField
from wtforms.validators import DataRequired,Email

class LoginForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired()])
    remember_me = BooleanField('Remember Me')
    submit = SubmitField('login')

class RegisterForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired()])
    confirm = PasswordField('Confirm', validators=[DataRequired()])
    submit = SubmitField('register')

class ChangeForm(FlaskForm):
	oldpassword = PasswordField('Password', validators=[DataRequired()])
	newpassword = PasswordField('Password', validators=[DataRequired()])
	confirm = PasswordField('Password', validators=[DataRequired()])
	submit = SubmitField('change')

