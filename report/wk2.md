---
title: Team 09 Report
subtitle: Week \#2
date: 13/03/2023
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

# Overview

This week was focused on setting up the server and the framework of the backend.
We also received answers to our questions on the forum, however, we had a response on the Friday (10/03/2023).
As such, we will be processing these come the next sprint.

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

| Task                                                                                |                                              Issue |   By |
| :---------------------------------------------------------------------------------- | -------------------------------------------------: | ---: |
| Created the GCP VM and installed the PHP dependencies.^[<https://getcomposer.org/>] | [#1](https://github.com/TWoolhouse/Slook/issues/1) |   TW |
| Decide the database ORM.                                                            | [#7](https://github.com/TWoolhouse/Slook/issues/7) |  All |
| Initialised the MySQL Database on GCP.                                              | [#2](https://github.com/TWoolhouse/Slook/issues/2) |   TW |
| Decide the backend PHP library: [Fast Route](https://github.com/nikic/FastRoute).   | [#7](https://github.com/TWoolhouse/Slook/issues/7) |   TW |
| Outlined the API routes needed for the text chat subsystem.                         | [#4](https://github.com/TWoolhouse/Slook/issues/4) |   TW |
| Designing possible frontend interfaces using Figma.                                 | [#6](https://github.com/TWoolhouse/Slook/issues/6) |   LT |
| Received answers to all our current questions (10/03/2023).                         |                                                    |      |

# Challenges Encountered

- The pre-installed version of PHP on the VM was not up-to-date. This had to be done manually.

# Tasks for the Next Sprint

| Task                                                               | Priority |
| :----------------------------------------------------------------- | -------: |
| Formalise the requirements as given in the responses on the forum. |     High |
| Finalise the Database Schema of the text chat.                     |     High |
| Implement the text chat subsystem API routes.                      |   Medium |
| Draft up the API routes for the data analysis subsystem.           |      Low |
