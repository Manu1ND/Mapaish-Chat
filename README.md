# MAPAISH Chat Server

MAPAISH Chat Server is an instant messaging solution built using vanilla JS for frontend with PHP and MariaDB for backend. It allows users to seamlessly communicate with each other. The project should be designed to very user friendly to use, enabling even a novice person to use it.


# Documentation

[Documentation](https://linktodocumentation)
### Abstract
Teleconferencing or Chatting, is a method of using technology to bring people
and ideas together despite geographical barriers. The technology has been
available for years but the acceptance was quite recent. Our project is an
example of a chat server(Mapaish). It is made up of 2 applications: the client
application, which runs on the user’s Web Browsers and server application,
which runs on PHP server. To start chatting, the client should register with our
platform where they can do private and group chat. Security measures like SQL
injection were taken care of while doing this project.

### Introduction
Communication is a means for people to exchange messages. It has started since
the beginning of human existence. Distant communication began as early as the
18 th century with the introduction of television, telegraph and then telephony.
Interestingly enough, telephone communication stands out as the fastest
growing technology, from fixed line to mobile wireless, from voice call to data
transfer.
The emergence of computer network and telecommunication technologies bears
the same objective, that is to allow people to communicate. Chatting is a method
of using technology to bring people and ideas together despite geographical
barriers. The technology has been available for years but the acceptance was
quite recent.
We created MAPAISH , a chat server, that runs on any modern web browser
and needs to be hosted on a PHP server. To start chatting, the user should
register and login to our chat application where they can do group and private
chatting.

### Hardware Requirements:

● Personal Computer
● 128 MB minimum RAM Required
● Internet or LAN Connections

### Software Requirement:

● Modern Browser
● PHP server
● Database Server

### Design

#### The application follows a 3-tier architecture

    1. Presentation layer (your PC, Tablet, Mobile, etc.)
    2. Application layer (PHP server)
    3. Database Server (MySQL, MariaD
![image](https://user-images.githubusercontent.com/73554415/134122274-0ef6a38c-964d-4852-8886-d5ccf5aa406d.png)

#### Technology Stack
![image](https://user-images.githubusercontent.com/73554415/134122328-0fa80301-8678-40a3-a0d6-13a81736abf3.png)

#### Use Cases
![Use Cases (1)](https://user-images.githubusercontent.com/73554415/134122646-94d8677d-a572-4394-a57f-a7d403ff14e9.jpg)

#### Client:

The user needs to register on Mapaish. The user then needs to login to access
the chatroom, where he can chat privately or in a group. The login and
registration form validation is done using jQuery library for Javascript , PHP
and Database . Duplicate usernames, and E-Mail IDs are validated against the
database using AJAX and PHP. When the user logins, the user session is created
to uniquely identify the user. The user can customise his profile with picture,
status and display name. The client sends requests to the PHP server for sending
messages or receiving new messages, which then checks the Database and sends
the responses to the client.

#### Modules:
1. Login/Register Validation (Login/Registration Page)

    1.1) Client side validation is done using jQuery and server side
    validation is done using AJAX, PHP and database.
2. Left Pane (Chat Page)

    2.1) It shows the recent contacts you’ve sent messages to.
    2.2) On the top left it shows the user the profile picture.
    2.3) Chat Menu ■ For new Chat/Group
    2.4) Hamburger Menu ■ Options to change user profile.
    2.5) Search button to filter contacts.
3. RightPane (Chat Page)

    3.1) It displays the main UI where the users can send and receive their
    messages.
    3.2) Hamburger Menu (only for group chats)
    ■ Options to change group settings.

#### Database Schema:
The SQL file in the project needs to be imported in MySQL/MariaDB Database
server.

![image](https://user-images.githubusercontent.com/73554415/134122686-324a79df-823e-469a-af38-429d0407bb99.png)

## Screenshots

#### Registration Tab:
![image](https://user-images.githubusercontent.com/73554415/134123216-d565412b-8044-4a21-88f9-344dfc6040ab.png)

#### Register Validation:
![image](https://user-images.githubusercontent.com/73554415/134123580-85a974c4-d77b-4507-b0e8-c7ee4e389130.png)

#### Chat Room:
![image](https://user-images.githubusercontent.com/73554415/134125385-8f5d7c05-f453-49f2-99f4-5c76f2759cd5.png)

#### Left Pane:
 ![image](https://user-images.githubusercontent.com/73554415/134124725-47509a0c-529d-473b-a3bf-7678bf3a8431.png)

#### Search: Search field filters Chat Room
![image](https://user-images.githubusercontent.com/73554415/134124767-f72473cc-2400-444b-9035-52b2e090589a.png)

#### Hamburger Menu Button:
![image](https://user-images.githubusercontent.com/73554415/134124816-3654787b-c972-4518-bc7e-f0bbf0a6fca2.png)
![image](https://user-images.githubusercontent.com/73554415/134124834-4d3795ad-99e6-4194-8fee-aef3482a42b4.png)
![image](https://user-images.githubusercontent.com/73554415/134124850-a117b41c-5fa7-46b4-8c78-68e65de6743d.png)

#### Message Button:
![image](https://user-images.githubusercontent.com/73554415/134125468-8286516b-94e3-4ce7-8f72-7901cf03297e.png)
![image](https://user-images.githubusercontent.com/73554415/134125475-a3ac3539-e0df-4a60-ad9c-f0717c3ea5cb.png)
![image](https://user-images.githubusercontent.com/73554415/134125481-782fc909-6a04-469d-8f2c-9408b4211e69.png)

#### Right Pane:
![image](https://user-images.githubusercontent.com/73554415/134125514-5518c2b8-7c9c-4a1e-8d85-c54871be9d27.png)

#### Message Field:
![image](https://user-images.githubusercontent.com/73554415/134125529-f224b43a-3051-4114-827d-d418c9576027.png)

#### Hamburger Menu Button for Group Chat:
![image](https://user-images.githubusercontent.com/73554415/134125557-ecbd6ed7-aa7b-4755-948f-9662471ad201.png)
![image](https://user-images.githubusercontent.com/73554415/134125571-c60e05d7-70db-4904-a4f0-39ae98dce2ba.png)
![image](https://user-images.githubusercontent.com/73554415/134125587-0de728a8-4317-428e-96b2-7e5e31b3bf06.png)
![image](https://user-images.githubusercontent.com/73554415/134125595-9f508186-1d98-4259-aafc-eb208290b9b2.png)









