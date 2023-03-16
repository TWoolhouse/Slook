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

Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Aenean placerat purus sit amet felis facilisis malesuada.
Aenean ligula ex, fringilla at arcu eget, vehicula lobortis felis.
Nam fringilla risus eget leo maximus, nec elementum urna pellentesque.
In maximus convallis finibus.
In vehicula diam pretium est porta, non feugiat orci tempor.

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

- Challenge 1
- Challenge 2
- Challenge 3

# Tasks for the Next Sprint

| Task                                                                           |   By | Priority |
| :----------------------------------------------------------------------------- | ---: | -------: |
| Really long and contrived example here to demonstrate the table looking decent |   AZ |     High |
| Task 1                                                                         |   AZ |     High |
| Task 2                                                                         |   AZ |   Medium |
| Task 3                                                                         |   AZ |      Low |