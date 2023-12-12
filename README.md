# PCAS-Capstone
PCAS - Password Checking and Storage
Pcas is a password manager program for my 2023 GCU Capstone Project
### What it is
Pcas is a custom built password manager web application that includes standard password vault capabilities using a MySql database. It also has a few additional features such as a secure password generator, and a connection to haveibeenpwned.com's compromised password API directly connected to the website via a python script to show if passwords have been compromised.
### Improvements
There are several improvements would need to be made for full functionality
-  Security Improvements
  -  the password database is not currently encrypted
  -  SQL Injection risk
  -  Better Password handling
  -  Segregation of password storage tables between users
- At scale calling of the compromised password API is not practical, password checking would need to utilize a locally stored list of compromised passwords that is updated on a regular basis
### Future
As things sit I don't plan on continuing with the project beyond the scope of this capstone project however, possible additional features our group did consider were
 - AI-based password crack time estimation
 - A buisness analytics dashboard
     - Count of reused passwords
     - Average crack time
     - Password complexity average
     - etc
### Contributors
Alex Putman, Mason Best, Tijana Zlaticanin Jelic, Monique Renteria

