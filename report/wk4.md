---
title: Team 09 Report
subtitle: Week \#4
date: 24/04/2023
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
pandoc .\report\wk4.md -o .\report\wk4.pdf
See: https://pandoc.org/
 -->

\hrule
\columnratio{0.6}
\Begin{paracol}{2}

# Progress

Week 4 saw the production of the first webpage in our source code. From here, on integrating with the API via fetch requests will leave us with the first fully working subsystem.

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

| Task                                      |                                                Issue |    By |
| :---------------------------------------- | ---------------------------------------------------: | ----: |
| Find a suitable PHP library for graphing. | [#18](https://github.com/TWoolhouse/Slook/issues/18) |    TW |
| Data analytics frontend design.           | [#16](https://github.com/TWoolhouse/Slook/issues/16) | FH,LT |
| Text chat frontend HTML & CSS mock-up.    | [#19](https://github.com/TWoolhouse/Slook/issues/19) |    AS |

# Challenges Encountered

- PHP is not suited towards producing images, so a good looking & easy to use library is hard to come by.

# Tasks for the Next Sprint

| Task                                                          |    For | Priority |
| :------------------------------------------------------------ | -----: | -------: |
| Integrate the chat API into our frontend webpage.             |     AS |     High |
| Implement data analytics API routes for both data and images. | LT, TW |     High |
| Add a functional login page.                                  |     AP |   Medium |
| Create the data analytics frontend HTML CSS.                  |     FH |      Low |
