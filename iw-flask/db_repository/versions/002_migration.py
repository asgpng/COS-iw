from sqlalchemy import *
from migrate import *


from migrate.changeset import schema
pre_meta = MetaData()
post_meta = MetaData()
form = Table('form', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('form_type', String(length=20)),
    Column('student_netID', String(length=20)),
    Column('advisor_netID', String(length=20)),
    Column('class_year', Integer),
    Column('coursework', String(length=20)),
    Column('title', String(length=128)),
    Column('description', String(length=2048)),
    Column('advisor_signature', Boolean),
    Column('advisor_department', String(length=128)),
    Column('student_signature', Boolean),
    Column('submitted', Boolean),
    Column('date', DateTime),
)

user = Table('user', post_meta,
    Column('netID', String(length=20), primary_key=True, nullable=False),
    Column('user_type', String(length=20)),
    Column('advisor_netID', String(length=20)),
    Column('second_reader_netID', String(length=20)),
)


def upgrade(migrate_engine):
    # Upgrade operations go here. Don't create your own engine; bind
    # migrate_engine to your metadata
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    post_meta.tables['form'].create()
    post_meta.tables['user'].columns['second_reader_netID'].create()


def downgrade(migrate_engine):
    # Operations to reverse the above upgrade go here.
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    post_meta.tables['form'].drop()
    post_meta.tables['user'].columns['second_reader_netID'].drop()
