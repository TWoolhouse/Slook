---
title: Team 09 Report
subtitle: Week \#1
author:
	- Frederick Hartgroves
	- Avkaran Klair
	- Arjun Parmar
	- Alexander John Somper
	- Louie Mcgregor Thomas
	- Thomas Roger Woolhouse
date: 06/03/2023
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

This weeks meeting pertained to team member introductions as well as an initial analysis of the specification.
We discussed how we would be working togeather going forwards, such as: creating a Kanban board; discussing technology stacks; and creating a template for the weekly reports.

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

- Initialised a [GitHub repository](https://github.com/TWoolhouse/Slook).
- Created a [Kanban board](https://github.com/users/TWoolhouse/projects/1) through github projects allowing us to track tasks during the project.
- Added tasks to the Kanban board to prepare agile development over the coming sprints.
- Asked first questions to the stakeholders to clarify the requested subsystems (*Textchat* & *Data Analysis*).
- Drafted up the an initial design for the database using an [ERD diagram](https://github.com/TWoolhouse/Slook/blob/8e355738836a9e33d93c89c8e4b4b31794b44ee3/design/schema.md)
- General discussion brainstorming the general structure of the whole system.

# Challenges Encountered

- The given specification is vague (i.e. *"data"* in the *Data Analytics* subsystem)

# Tasks for the Next Sprint

| Task                                                                                             | Priority |
| :----------------------------------------------------------------------------------------------- | -------: |
| Establish a full technology stack.                                                               |     High |
| Create a GCP virtual machine to host the API.                                                    |     High |
| Install a Database on the server.                                                                |     High |
| Draft up the required API routes for the system as specified so far.                             |   Medium |
| Create a [Figma](https://www.figma.com/) to create a cohesive design for our front-end webpages. |      Low |
