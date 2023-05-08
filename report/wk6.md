---
title: Team 09 Report
subtitle: Week \#6
date: 08/05/2023
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
pandoc .\report\wk1.md -o .\report\wk1.pdf
See: https://pandoc.org/
 -->

\hrule
\columnratio{0.6}
\Begin{paracol}{2}

# Progress

The system now has a landing page with direct links to the text chat and data analytics subsystems.
Furthermore, the whole text chat system is done and dusted.

\switchcolumn

# Attendees

- [x] FH - Frederick Hartgroves
- [ ] AK - Avkaran Klair
- [x] AP - Arjun Parmar
- [x] AS - Alexander John Somper
- [x] LT - Louie Mcgregor Thomas
- [x] TW - Thomas Roger Woolhouse

\End{paracol}

# Tasks Completed Last Sprint

| Task                                                  |                                                Issue |     By |
| :---------------------------------------------------- | ---------------------------------------------------: | -----: |
| Implemented the text chat system in full              | [#19](https://github.com/TWoolhouse/Slook/issues/19) |     TW |
| Login home page                                       | [#15](https://github.com/TWoolhouse/Slook/issues/15) | AP, TW |
| Implemented most of the routes for the data analytics | [#18](https://github.com/TWoolhouse/Slook/issues/18) |     LT |

# Challenges Encountered

- Creating a consistent styling for the text chat and login page.
- Adding fake data to the database for testing purposes.
- Trouble with XAMPP installation

# Tasks for the Next Sprint

| Task                    |  For | Priority |
| :---------------------- | ---: | -------: |
| Data analytics frontend |   TW |     High |
| Final Report            |  All |     High |
| Presentation Plan       |  All |   Medium |
