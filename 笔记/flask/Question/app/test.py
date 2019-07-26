from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from werkzeug.security import generate_password_hash, \
     check_password_hash

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:root@localhost:3306/flask'
db = SQLAlchemy(app)
class User(db.Model):
    user_id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password_hash = db.Column(db.String(120),unique=True, nullable=False)


    def __init__(self, username, password):
        self.username = username
        self.password_hash = generate_password_hash(password)

    def set_password(self, password):
        self.password_hash = generate_password_hash(password)

    def check_password(self, password):
        return check_password_hash(self.password_hash, password)

'''db.create_all()
user = User(username = 'tinmin', password = '123')
db.session.add(user)
db.session.commit()'''
'''user = User.query.filter_by(username = 'tinmin').first()
print(user.check_password('123'))'''
user = User.query.filter_by(password_hash = '123' ).first()
print(user)


'''db.session.add(user)
db.session.commit()'''
'''print(User.query.filter_by(username = '123').first())'''
'''user = User(username = 'tinmin')
user.set_password("123")
db.session.add(user)
db.session.commit()'''
#db.session.add(me)
#db.session.commit()
