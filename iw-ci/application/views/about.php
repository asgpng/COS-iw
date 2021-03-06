<h2>About</h2>
<h3>Description</h3>
<p>
Our SPE '13 project was a prototype of a website for the independent work of Princeton's Computer Science Department. The existing system was still paper-based, which meant that students had to print out forms, fill them out by hand, walk to their advisor's office to have them fill forms out, and eventually turn forms in to Colleen, the COS secretary, who would manaully enter the data into a Google Doc. As such, the premise of this project was to increase the efficiency by digitizing these forms. These web forms were integrated into a website which will allow students and faculty to submit forms, view deadlines, and give feedback. On the administrative side, we added features for viewing and adding users, as well as viewing submitted forms and exporting form data to a csv file.
</p>
<h3>Development Process</h3>
<p>
We began SPE by learning the basics of the tools we would be using - html, css, Jinja2, javascript, and Python. After some deliberation, we decided to develop on Google's App Engine, which provided a convenient way to write pages and test them on a localhost developmental server. After about three weeks of SPE, we had basic form functionality, user permissions, and administrative capabilities. It was around this time that we met with Scott Karlin, the COS Department Head, to discuss the possibility of deploying our website on the Princeton CS server. Although this was a definite possibility, doing so would involve transitioning our code from the Google App Engine state to something that would work on the CS Server. As it turns out, this would be the most difficult part of SPE for us.
</p>
<p>
Our initial attempt at transitioning involved running basic 'hello world' python scripts via cgi. This proved simple enough, but when we tried to import our webapp2 (GAE) code, it immediately broke. As we were unable to access error logs, these issues were very difficult to debug. After some days of trying on and off, we were finally able to successfuly run our site on the CS server using Python's Flask microframework. This in and of itself would involve a significant amount of restructuring, but at least we would be able to remain in the Python world (so we thought). However, after two days or so in Flask, we discovered a bug which prevented the successful execution of POST methods via CGI, in spite of the fact that there were no problems on Flask's developmental server. After looking through the error logs and poring over hundreds of lines of Flask code, we decided to try something else. Initially, we thought use Django instead, but after reading that it didn't support cgi, we decided to leave the Python world and transition to PHP, which was fully supported by the CS servers.
</p>
<p>
This decision took place on Friday of week 5, and the next few days would be the busiest and most productive days of SPE. In about a week, we almost completely replicated the functionality of our previous GAE prototype in PHP with a framework called CodeIgniter. We also added new features such as exporting to csv and redirecting to the original requested page when a user is prevented access and required to login.
</p>
<h3>Existing Issues</h3>
<p>
Before being deployed in production, our app needs a few modifications. In particular, the upload feature currently seems to only support uploading images, while having the ability to upload a csv file will be very useful for the administrator, so they can add users to the database in mass. Additionally, it would be nice to have a feature to notify a user, for example, if they have been requested to advise a student on a project, or alternatively, if a deadline for a particular form is coming up. These features should not be too difficult to implement, but we didn't really have time to implement them, given the lateness of our decision to transition to PHP.
</p>
<h3>Looking Ahead</h3>
<p>
In retrospect, it would have been nice to have an additional week to iron out the details or to have switched to PHP a week earlier, but all in all, we are pleased with our results and thankful for the opportunity to learn so much during SPE. In addition, we are excited that it looks possible for our site to go into production this coming fall, with some modifications and extensions by the COS department. In the end, the outcome of our SPE experience was overwhelmingly positive in all regards: we created an application that will make a previously complicated process efficient and trivial, and in the process, we developed a plethora of web development skills that will be sure to come in useful to us in the future.
</p>
<p>The Github repository for this project can be found here: <a href="https://github.com/asgpng/COS-iw"></p>
