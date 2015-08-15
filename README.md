# BadiCal
Library to translate between Gregorian and [Badi / Bahai](https://en.wikipedia.org/wiki/Bah%C3%A1%27%C3%AD_calendar) calendars.

See it in action: http://www.dmcblue.com/badical/

Translations default to 'day of' dates.  Meaning 172-01-01 BE translates to 2015-03-21.  There are options to get the Gregorian evening on which a Badi date starts, etc.

The library uses precalculated NawRuz dates from http://wilmetteinstitute.org/wp-content/uploads/2014/11/Bahai-Dates-172-to-221-B-E-_UK-December-2014.pdf .  Please report any errors (see BadiCal.NAWRUZ).

It currently has very simple functionality and interface.  As it's used more, functionality may be added and the usage interface may be made more dynamic/easy-to-use.

It was originally written for Javascript and has a port to PHP.

##Files
###Javascript
####The Library
**BadiCal.js** - This is the only file needed to use the library, other files are only for testing.

####Testing
**test.html** - Page that goes through a list dates and compares the translation to the expected translation.

**jquery-2.1.1.min.js** - Necessary for test.html.

###PHP
####The Library
**load.php** - Only file needed to be called in order to use the library (require_once).
**BadiBase.php** - Basic static values and utility functions.
**BadiDate.php** - BadiDate class used to house date information.
**BadiCal.php** - Runs the transformations.


####Testing
**test.php** - Script that goes through a list dates and compares the translation to the expected translation. Can be run from terminal or as webpage.

##Use
BadiCal (currently) works primarily with 'static' translation functions and 'BadiDate' objects.

Javascript: Everything is contained in the 'BadiCal' global object.

The following examples are in Javascript but are simple translations to PHP. (Will add such translations here at a later point)

###Translation
**BadiCal.BadiToGregorian(year, month, day, startsOn)**

@param Integer year = Year in the Badi Calendar (1 or greater)

@param Integer month = Month in the Badi Calendar [1 - 20].  19 stands for Ayyam-i-Há, 20 for Alá. 

@param Integer day = Day of month [1 - 19 (1 - 4/5 for Ayyam-i-Há)]

@param Bool startsOn = [Optional, default=false] If true, gets the Gregorian date on which the Badi date starts.  If false, gets the Gregorian date on which the Badi date ends.

@return BadiDate - BadiCal.BadiDate object whose values represent the respective Gregorian date.

####Usage Example
```javascript
var gregdate = BadiCal.BadiToGregorian(172, 1, 1); //NawRuz 2015
console.log(gregdate.year()); //2015
console.log(gregdate.month()); //3
console.log(gregdate.day()); //21
```

**BadiCal.GregorianToBadi(year, month, day, startOf)**

@param Integer year = Year in the Gregorian Calendar (1844 or greater)

@param Integer month = Month in the Gregorian Calendar [1 - 12]. **NOTE:** This is (1) based NOT (0) like the native Javascript Date object. 

@param Integer day = Day of month [1 - 31].

@param Bool startOf = [Optional, default=false] If true, gets the Badi date which starts on this Gregorian date.  If false, gets the Badi date which ends on this Gregorian date.

@return BadiDate - BadiCal.BadiDate object whose values represent the respective Badi date.

####Usage Example
```javascript
var badidate = BadiCal.GregorianToBadi(2015, 3, 21); //NawRuz 2015
console.log(badidate.year()); //172
console.log(badidate.month()); //1
console.log(badidate.day()); //1
```

	
###BadiDate object
This object is used both internally for the library and as the output.  Each object contains some convenience functions.  Each object can contain either CE or BE dates.

**'Constructor'** newnew BadiCal.BadiDate(year, month, day, BadiCal.BADI)

@param Integer year

@param Integer month 

@param Integer day

@param String type = Expresses the calendar type represented by the object. Expects library variables BadiCal.GREGORIAN or BadiCal.BADI

####Usage Example
```javascript
var bDate = new BadiCal.BadiDate(172, 1, 1, BadiCal.BADI);//Nawruz 2015
```

**function year(format)**

@param format = [Optional, default=false] Pads single digits with prepended '0' (zero).

@return Year represented by this object.

**function month(format)**

@param format = [Optional, default=false] Pads single digits with prepended '0' (zero).

@return Month represented by this object.


**function monthName()**

@return Month name (in English for Gregorian).

**function day(format)**

@param format = [Optional, default=false] Pads single digits with prepended '0' (zero).

@return Day represented by this object.


###Other
There are some other functions and variables attached to the BadiCal object which are used internally and may be useful to developers.

**BadiCal.GREGORIAN**

Used as BadiDate type for CE dates

**BadiCal.BADI**

Used as BadiDate type for BE dates.

**BadiCal.BADI_MONTHS**

Array with names for Badi Calendar months (zero based).  Includes Ayyam-i-Há.

**BadiCal.getAyyamiha(bYear)**

@param Integer bYear = Year on Badi calendar [1 or greater];

@return Integer = Length of Ayyam-i-Há in that BE year [4-5]

##Suggestions
If there is specific functionality or easy usage missing, please let me know.  I will try to add to the library (support Javascript Date, etc).

I may even expand this to other scripting languages.







