from app import app,db,login_manager
from flask_login import LoginManager, UserMixin, \
                                login_required, login_user, logout_user 
from werkzeug.security import generate_password_hash, \
     check_password_hash

class User(UserMixin,db.Model):
    user_id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password_hash = db.Column(db.String(120))


    def __init__(self, username, password):
        self.username = username
        self.set_password(password)

    def set_password(self, password):
        self.password_hash = generate_password_hash(password)

    def check_password(self, password):
        return check_password_hash(self.password_hash, password)

    def __repr__(self):
        return "%d/%s/%s" % (self.id, self.name, self.password)
    
    def get_id(self):   #NotImplementedError: No `id` attribute - override `get_id`
        return (self.user_id)

    def get_username(self):
        return (self.username)
#db.create_all() #创建表

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))