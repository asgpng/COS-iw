from functools import wraps
from flask import request, render_template, session
from models import User

def template(template=None):
    def decorator(f):
        @wraps(f)
        def decorated_function(*args, **kwargs):
            template_name = template
            if template_name is None:
                template_name = request.endpoint \
                    .replace('.', '/') + '.html'
            ctx = f(*args, **kwargs)
            if ctx is None:
                ctx = {}
            elif not isinstance(ctx, dict):
                return ctx
            return render_template(template_name, **ctx)
        return decorated_function
    return decorator

def login_user(user, netID):
    if user != None:
        current_user = user
    else:
        # current_user = User(netID=netID, user_type = 'default')
        # db.session.add(current_user)
        # db.session.commit()
        pass
    session['user'] =  current_user
