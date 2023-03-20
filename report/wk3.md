---
title: Team 09 Report
subtitle: Week \#3
date: 20/03/2023
numbersections: false
documentclass: article
papersize: A4
fontsize: 11pt
geometry: "left=1.5cm,right=1.5cm,top=0cm,bottom=1.5cm"
links-as-notes: true
header-includes: |
	\usepackage{paracol}
	\usepackage{titling}
	\newcommand{\hideFromPandoc}[1]{#1}
	\hideFromPandoc{
		\let\Begin\begin
		\let\End\end
	}
	\preauthor{}
	\postauthor{}
	\author{}
	\setlength{\columnsep}{20pt}
---

<!-- Compile Instructions:
pandoc .\report\wk3.md -o .\report\wk3.pdf
See: https://pandoc.org/
 -->

\hrule
\columnratio{0.6}
\Begin{paracol}{2}

# Progress

Acting on the answers we recieved to our questions on the forum, we discussed how we would set up the database for the data analytics subsystem.
Additionally, we created a design for how the text chat subsystem will look.

\switchcolumn

# Attendees

- [x] FH - Frederick Hartgroves
- [ ] AK - Avkaran Klair
- [ ] AP - Arjun Parmar (Interview)
- [x] AS - Alexander John Somper
- [x] LT - Louie Mcgregor Thomas
- [x] TW - Thomas Roger Woolhouse

\End{paracol}

# Tasks Completed Last Sprint

| Task                        |                                              Issue |             By |
| :-------------------------- | -------------------------------------------------: | -------------: |
| Finalised Tech Stack        | [#7](https://github.com/TWoolhouse/Slook/issues/7) |     AP, AS, LT |
| Database schema finalised.  | [#5](https://github.com/TWoolhouse/Slook/issues/5) | FH, AS, LT, TW |
| Database uploaded on GCP.   | [#2](https://github.com/TWoolhouse/Slook/issues/2) |             TW |
| Frontend Text Chat Designed | [#8](https://github.com/TWoolhouse/Slook/issues/8) |     AP, AS, LT |

# Challenges Encountered

- We were initially unsure about the specific data that should be returned by the data analytics subsystem.
- Had to define the scope of employee, team leader, and manager for data analytics.

# Tasks for the Next Sprint

| Task                                                                           |  By | Priority |
| :----------------------------------------------------------------------------- | --: | -------: |
| Really long and contrived example here to demonstrate the table looking decent |  AZ |     High |
| Task 1                                                                         |  AZ |     High |
| Create the frontend of the text chat subsystem using HTML, CSS and JavaScript  |  AS |   Medium |
| Design a potential frontend interface for the Data Analytics showcase          |  LT |      Low |
