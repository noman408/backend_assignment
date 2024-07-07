Hi,

I have prepared this given assignment for the position of Backend Developer (PHP/Yii). I completed this assignment in Yii framework. Following is the flow /demo of the application. Let's Start!

1 - When you will successful run the project, it will display an index page writing congratulations on it.

2 - On the navbar there are 3 menus, i.e Home, Login & signup

3 - First you will signup, it will show you the 3 fields, all are required fields. Email must be unique as well. Rather than writing unique in model of SignupForm, I have implemented Ajax call that gets all data from user and then return in Ajax successful function. Minimum length of password I have placed is 6. 

4 - After signup, the verification screen will appear. Where user will enter the OTP or some code that will be sent by an email in production. However, here in this project, I am taking it from database directly to understand the concept. It will prompt the verification token, after the token is verified, it will take you to the login page showing that you have successfully verified.

5 - When verification is done, now you can login the project.

6 - Upon successful login, you will see the button to create blogpost. When you will create the blog post, there are 3 fields again in this form. T.e Title, description & status. When you will fill the 3 fields it will take you to the index page showing your all blog posts.

7 - When you have multiple blogposts in index page, there are controls on the card of blogpost. You can edit the blogpost as well by clicking edit button.

8 - There is also a like/unlike functionality. On each post, there is like button (if post is not liked). If you will like the post, it will count the number and through Ajax the page will be loaded and button will be changed to unlike. Likewise, if you will unlike the button, it will decrease the counter & reload and button changed to Like. Also, 1 user can only like the post one time. Like on a post is recorded per user. User id is saved with the post id in database.

9 - After that crud, you can logout the application. 

You can login from:
Username : Nouman
Password : 123456

One thing that is missing from the requirements is search filter with search model and customView. I have knowledge about the search models and dataProvider and then put it in customPJax. I really apologize I could not implement in it. Rest of the things I have implemented.


Thanks & regards,
Nouman Aslam
