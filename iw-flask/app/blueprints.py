from flask import Blueprint, render_template, abort
from jinja2 import TemplateNotFound

forms = Blueprint('forms', __name__, template_folder='templates/forms')

@forms.route('/', defaults={'form': 'index'})
@forms.route('/<form>')
def show(form):
    try:
        return render_template('%s.html' % form)
    except TemplateNotFound:
        abort(404)
