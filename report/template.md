---
title: Team 09 Report
subtitle: Week \#NUMBER
author:
	- Frederick Hartgroves
	- Avkaran Klair
	- Arjun Parmar
	- Alexander John Somper
	- Louie Mcgregor Thomas
	- Thomas Roger Woolhouse
date: DD/MM/2023
numbersections: false
documentclass: article
papersize: A4
fontsize: 11pt
geometry: "left=1.5cm,right=1.5cm,top=0cm,bottom=1.5cm"
links-as-notes: true
header-includes: |
	\usepackage{multicol}
	\usepackage{paracol}
	\usepackage{blindtext}
	\newcommand{\hideFromPandoc}[1]{#1}
	\hideFromPandoc{
		\let\Begin\begin
		\let\End\end
	}
	\setlength{\columnsep}{20pt}
---

<!-- Compile Instructions:
pandoc .\report\wk1.md -o .\report\wk1.pdf
See: https://pandoc.org/
 -->

\hrule
\columnratio{0.65}
\Begin{paracol}{2}

# Overview

Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Aenean placerat purus sit amet felis facilisis malesuada.
Aenean ligula ex, fringilla at arcu eget, vehicula lobortis felis.
Nam fringilla risus eget leo maximus, nec elementum urna pellentesque.
In maximus convallis finibus.
In vehicula diam pretium est porta, non feugiat orci tempor.

\switchcolumn

# Attendees

- [x] Frederick Hartgroves
- [x] Avkaran Klair
- [x] Arjun Parmar
- [x] Alexander John Somper
- [x] Louie Mcgregor Thomas
- [x] Thomas Roger Woolhouse

\End{paracol}

# Tasks Completed Last Sprint

- Task 1
- Task 2
- Task 3

# Challenges Encountered

- Challenge 1
- Challenge 2
- Challenge 3

# Tasks for the Next Sprint

| Task                                                                           | Priority |
| :----------------------------------------------------------------------------- | -------: |
| Really long and contrived example here to demonstrate the table looking decent |     High |
| Task 1                                                                         |     High |
| Task 2                                                                         |   Medium |
| Task 3                                                                         |      Low |
