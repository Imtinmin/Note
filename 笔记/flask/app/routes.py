# -*-coding:utf-8 -*-
from flask import Flask,render_template,redirect,request,flash,url_for,session
from forms import LoginForm,RegisterForm
from app import app,db
from models import User


@app.route('/')
def index():
    return "Hello World"


@app.route('/register', methods=['GET', 'POST'])
def register():
    # Here we use a class of some kind to represent and validate our
    # client-side form data. For example, WTForms is a library that will
    # handle this for us, and we use a custom LoginForm to validate.
    form = RegisterForm()
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        email = request.form.get('email')
        confirm = request.form.get('confirm')
        if password == confirm:
            user = User(username=username)
            user.set_password(password)
            db.session.add(user)
            db.session.commit()
            flash('Rigister successfully')
        else:
            flash('Confirm is wrong')
        return redirect(url_for('login'))
    return render_template('register.html',form=form)

@app.route('/login',methods=['GET','post'])
def login():
    form = LoginForm()
    if request.method == 'POST':

        username = request.form.get('username')
        password = request.form.get('password')
        session['user'] = name
        user = User()
        user = User.query.filter_by(username=username).first()
        if user is None or not user.check_password(form.password.data):
            flash('Invalid username or password')
            return redirect(url_for('login'))
        else:
            flash('Login ')
    return render_template('login.html',form=form)
    #print username
    #print password
    '''if form.validate_on_submit():
        # Login and validate the user.
        # user should be an instance of your `User` class
        login_user(user)

        flask.flash('Logged in successfully.')

        next = flask.request.args.get('next')
        # next_is_valid should check if the user has valid
        # permission to access the `next` url
        if not next_is_valid(next):
            return flask.abort(400)

    return render_template('register.html', form=form)'''

