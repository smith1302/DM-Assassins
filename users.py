#!/usr/bin/env python

import sys
import time
import json

outputList = []

def processLine(line):
	line = line.strip()
	tokens = line.split(',')
	currentName = {}
	currentName['name']=tokens[0];
	currentName['username']=tokens[1];
	currentName['email']=tokens[2];
	currentName['team']=tokens[3]
#	print currentName;

	global outputList;
	outputList += [currentName];

		
if __name__ == "__main__":
	filename = sys.argv[1]
	namesList = open(filename,'r')

	for line in namesList:
		processLine(line)
	
	output = open('output.json','w')
	print json.dumps(outputList)
	output.write(json.dumps(outputList))
#	json.dumps(outputList)