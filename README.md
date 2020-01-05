# developer
This is mini PHP MVC application 

-- DATABASE INSERT VALUES--

First you need to insert data to your database if it is empty.
Table "parents" you need to insert data such as Front End Developer and Back End Developer, this is users type.

Second table that you need to insert values is "user_type". This is subtype of values that you have allready insert into table "parents".

-- APPLICATION FUNCTIONS --
With this application users can first register to use basic functions of application. After successfuly register user can log in.
Then he can eather add posts or search other users by their type or subtype.By typing any text in the search field and submitting the form,
user will be redericted to the results screen where he can see matched results. User also can go to post page where he can add some posts,
if he is successfuly logged in. He can also read other posts but he cannot edit or delete posts from other users.

-- APPLICATION USAGE--

http://localhost/developer/ - first page
On first page you can log in if you have allready registrated in database if not you can click on button register.
If you need to register by filing out simple form.

After user succesfuly have registrated, he needs to login by hes user email and password.

http://localhost/developer/index - welcome page after user is loged in
On this page user can search by  typing any text in the search field and submitting the form, the app should redirect the
user to the Results Screen and display the list of matching results.

http://localhost/developer/posts/index - post page
If user is successfuly logged in he can see post from other users, and also add some of hes.
Also there is added edit and delete buttons where user can either update post or delete. He do not have possibility to change or delete 
other posts that he did not created


Created by Ilijan Militar

