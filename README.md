# Project Details: tidywork.space
## Inspiration
We were inspired by Trello to make our own version of a web app that enhances people’s productivity. One way to do that is to fully organize one’s tasks, so people know exactly what they need to be working on at what time. We wanted people to give people the ability to arrange their tasks by subject or project and manage their workflow easily.

## What it does
TidyWorks lets users create a board with different lists. These lists are split up into to-do, doing, and done lists, but the user can further customize these lists to suit their needs. The user can add boxes for specific tasks and make comments in those boxes on how the task should be done.
TidyWorks also comes in with a hardware assistant. The hardware assistant idea and personalized screen that helps you focus better on the work. You can view your current task, as well as to Set timers to time how much time you work on the project, setup counters (to block 20 minutes worktimes countdown) , complete cards: that update to our backend and also change the cards you are working on.  

## How we built it
On the front-end side, we used html, css, javascript, and bootstrap to create an interactive website.
On the back-end side, we used PHP, MySql, and JSON.
We built the hardware using Arduino mega based on atmega 2560, ESP8266 NodeMCU, TFT TouchScreen.

## Challenges we ran into

**Front-End:** Only one team member was familiar with VueJS, so it was a lot of work trying to code a functional website.

**Hardware improvisation:** We didn’t have a wifi modulo, but we did have a microcontroller that could connect to the internet (ESP8266), so we had to improvise and make the arduino mega communicate somehow with the ESP8266, somehow.

**IOT:** It was hard to process all the arduino and handle communication between different microcontrollers (Arduino atmega2560 and arduino)

**JSON in arduino:** Parsing JSON from arduino was a major challenge.

**Electronic Noise:** In hardware there seems to be a lot of problems regarding noises. For example, reading if a led is on can be a major difficulty due to it sometimes returning false positives. To solve this, we had to compute the average of the readings and estimate if it was an ON/OFF.

**Touch Screen:** We had to use a lot of math in order to calculate where to write the texts, where to write the rectangles, where to indicate them as input buttons, etc...


## Accomplishments that we're proud of

We’re proud of the nice backend API that we built. In addition, the hardware is a big accomplishment because this is the first hackathon where we tried out building hardware. We’re also proud of building a website that functions and does not have a lot of bugs.

## What we learned
Due to our varying skill sets, we were able to learn things off of each other like basic html/css and javascript syntax.

## What's next for TidyWork
We want to implement a sign-in page which allows for multiple users. This can allow private boards or shared boards between users.

We want to make TidyWorks into a mobile app. We already [prototyped](https://www.figma.com/proto/dhrBZR1AHtMaITQknN6ljC/TidyTheHack?node-id=43%3A13&viewport=149%2C343%2C0.44628095626831055&scaling=scale-down) it, but we need to make it functional

Hardware: We haven't designed a 3d model for the case yet, but the idea is to add a velcro on the back and stick it to the monitor side or the wall (similar to how it is shown on the demo). 

