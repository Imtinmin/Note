from flask import Flask,render_template,render_template_string,request,flash,redirect,session
from flask_login import login_user,logout_user,login_required,current_user
from app import app,db
from app.forms import LoginForm,RegisterForm,ChangeForm
from app.models import User


@app.route('/')
def index():
	return render_template('index.html')

@app.route('/login',methods=['GET','POST'])		#登录
def login():
	form = LoginForm()
	if request.method == 'POST':
		username = request.form['username']
		password = request.form['password']
		session['name'] = username
		user = User.query.filter_by(username = username).first()
		if user is None or not user.check_password(password):
			flash('The password is error')
			return redirect('/login')
		login_user(user)
		flash('Login success!')
		return redirect('/')
	return render_template('login.html',form=form)


@app.route('/register',methods=['GET','POST'])	#注册
def register():
	form = RegisterForm()
	if request.method == 'POST':
		username = request.form['username']
		password = request.form['password']
		confirm = request.form['confirm']
		if not password == confirm:
			flash('两次输入密码不一致')
			return redirect('/register')
		if User.query.filter_by(username = username).first():
			flash('The username has been registered')
			redirect('/register')
		user = User(username = username,password = password)
		db.session.add(user)
		db.session.commit()
		flash('注册成功')
		return redirect('/login')
		
	return render_template('register.html',form=form)




@app.errorhandler(404)	#SSTI注入
def page_not_found(e):
    template = '''
        <div class="center-content error">
            <h1>Oops! That page doesn't exist.</h1>
            <h3>%s</h3>
        </div> 
    ''' %(request.url)

    return render_template_string(template)


@app.route("/logout")	#注销
@login_required
def logout():
    logout_user()
    session['name'] = False
    return redirect('/')

@app.route('/change',methods=['GET','POST'])
def edit():
	form = ChangeForm()
	if not current_user.is_authenticated:
		flash('你还没登陆呢')
		redirect('/')
	if request.method =='POST':
		oldpassword = request.form['oldpassword']
		newpassword = request.form['newpassword']
		confirm = request.form['confirm']
		if not current_user.check_password(oldpassword):
			flash('旧密码不正确')
			return redirect('/change')
		if not confirm == newpassword:
			flash('两次输入密码不一致')
			return redirect('/change')
		current_user.set_password(newpassword)
		db.session.commit()
		flash('修改成功')
	return render_template('change.html',form=form)