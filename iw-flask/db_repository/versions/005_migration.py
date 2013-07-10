from sqlalchemy import *
from migrate import *


from migrate.changeset import schema
pre_meta = MetaData()
post_meta = MetaData()
signup_form = Table('signup_form', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('class_year', Integer),
    Column('coursework', String(length=20)),
    Column('advisor_signature', Boolean),
    Column('advisor_department', String(length=128)),
    Column('student_signature', Boolean),
)


def upgrade(migrate_engine):
    # Upgrade operations go here. Don't create your own engine; bind
    # migrate_engine to your metadata
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    post_meta.tables['signup_form'].create()


def downgrade(migrate_engine):
    # Operations to reverse the above upgrade go here.
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    post_meta.tables['signup_form'].drop()
