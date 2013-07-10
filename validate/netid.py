def validate(netID):
	 query_params = {'netID': sf.advisor_netID}
     query = object_query(Faculty, query_params)
     user_faculty = query.get()
     return (user_faculty == NoneType)	