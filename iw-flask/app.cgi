#!/usr/bin/env python

# activate_this = '/srv/http/cgi-bin/modules/bin/activate_this.py'
# execfile(activate_this, dict(__file__=activate_this))

# import site
# site.addsitedir("/u/asg4/public_html/cgi-test/modules//lib/python2.6/site-packages")
from wsgiref.handlers import CGIHandler
from app import app

if __name__=='__main__':
    app.run()

CGIHandler().run(app)
