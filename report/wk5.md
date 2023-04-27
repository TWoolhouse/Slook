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

Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Aenean placerat purus sit amet felis facilisis malesuada.
Aenean ligula ex, fringilla at arcu eget, vehicula lobortis felis.
Nam fringilla risus eget leo maximus, nec elementum urna pellentesque.
In maximus convallis finibus.
In vehicula diam pretium est porta, non feugiat orci tempor.

\switchcolumn

# Attendees

- [x] FH - Frederick Hartgroves
- [x] AK - Avkaran Klair
- [x] AP - Arjun Parmar
- [x] AS - Alexander John Somper
- [x] LT - Louie Mcgregor Thomas
- [x] TW - Thomas Roger Woolhouse

\End{paracol}

# Tasks Completed Last Sprint

| Task   |                                              Issue |     By |
| :----- | -------------------------------------------------: | -----: |
| Task 1 | [#0](https://github.com/TWoolhouse/Slook/issues/0) |     AZ |
| Task 2 |                                                etc | AZ, AZ |
| Task 3 |                                                etc |     AZ |

# Challenges Encountered

- Accessing the DB for logging in???

# Tasks for the Next Sprint

| Task                                                                           |  For | Priority |
| :----------------------------------------------------------------------------- | ---: | -------: |
| Really long and contrived example here to demonstrate the table looking decent |   AZ |     High |
| Task 1                                                                         |   AZ |     High |
| Task 2                                                                         |   AZ |   Medium |
| Task 3                                                                         |   AZ |      Low |
