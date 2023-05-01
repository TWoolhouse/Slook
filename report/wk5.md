---
title: Team 09 Report
subtitle: Week \#5
date: 01/05/2023
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

This weeks progress has given us a clean login page design allowing for the login page to be completed without any further design or discussion.
The backend for the data analytics provides a framework allowing for dynamically switching between a server-side graph or the raw data based upon query parameters.

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

| Task                                     |                                                Issue |   By |
| :--------------------------------------- | ---------------------------------------------------: | ---: |
| Integrated an image for optional graphs. | [#18](https://github.com/TWoolhouse/Slook/issues/18) |   TW |
| Login page frontend design.              | [#15](https://github.com/TWoolhouse/Slook/issues/15) |   AP |

# Challenges Encountered

- Accessing the DB for logging the user in.

# Tasks for the Next Sprint

| Task                                                        |    For | Priority |
| :---------------------------------------------------------- | -----: | -------: |
| Integrate the chat API into our frontend webpage.           |     AS |     High |
| Implement data analytics API routes with the new framework. | LT, TW |     High |
| Create the working login page.                              |     AP |   Medium |
| Create the data analytics frontend HTML CSS.                |     FH |      Low |
