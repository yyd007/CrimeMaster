DROP TABLE IF EXISTS Books;
CREATE TABLE Books (
         BookTitle varchar(200) PRIMARY KEY,
         AuthorName varchar(200),
         Languages varchar(100),
         Length int,
         Country varchar(100)
         );

DROP TABLE IF EXISTS Series;        
CREATE TABLE Series (
         SeriesName varchar(200) PRIMARY KEY,
         AuthorName varchar(100),
         LeadingCharacter varchar(100)
         );

DROP TABLE IF EXISTS Authors;
CREATE TABLE Authors (
         AuthorName varchar(200) PRIMARY KEY,
         Gender varchar(50),
         Nationality varchar(100)
         );

DROP TABLE IF EXISTS Characters;
CREATE TABLE Characters (
         CharacterName varchar(200),
         CharacterID int PRIMARY KEY,
         Gender varchar(50),
         Nationality varchar(100)
         );

DROP TABLE IF EXISTS CharacterRole;
CREATE TABLE CharacterRole (         
         CharacterRoleID int,
         CharacterRoleType varchar(200),
          PRIMARY KEY(CharacterRoleID, CharacterRoleType)
         );

DROP TABLE IF EXISTS Crime;        
CREATE TABLE Crime (
         CrimeID int,
         CrimeName varchar(200) ,
         motive varchar(200),
         PRIMARY KEY(CrimeID, CrimeName)
         );

DROP TABLE IF EXISTS Detevtive;
CREATE TABLE Detevtive (   
         DetectiveName varchar(200) PRIMARY KEY,
         OrganizationName char(100),
         Gender varchar(200),
         Nationality varchar(200)
         );


DROP TABLE IF EXISTS Subgenre;
CREATE TABLE Subgenre (
         GenreName varchar(200) PRIMARY KEY,
         TimeofPopularity varchar(200)
         );        

DROP TABLE IF EXISTS BelongTo;
CREATE TABLE BelongTo (
         BookTitle varchar(200),  
         GenreName varchar(200),
         PRIMARY KEY (BookTitle, GenreName)
         );

DROP TABLE IF EXISTS IsIn;
CREATE TABLE IsIn (
         BookTitle varchar(200), 
         SeriesName varchar(200),
         PRIMARY KEY (BookTitle, SeriesName)
         );



DROP TABLE IF EXISTS Writes;         
CREATE TABLE Writes (         
         AuthorName varchar(200),
         BookTitle varchar(200), 
         PRIMARY KEY (BookTitle, AuthorName)
         );

DROP TABLE IF EXISTS Has;
CREATE TABLE Has (        
         BookTitle varchar(200),
         CharacterRoleID int,
         CharacterRoleType varchar(200),
         PRIMARY KEY (BookTitle, CharacterRoleID)
         );


DROP TABLE IF EXISTS Creates;
CREATE TABLE Creates (
         CharacterID int, 
         AuthorName varchar(200),
         PRIMARY KEY (AuthorName, CharacterID)
         );

DROP TABLE IF EXISTS Commits;
CREATE TABLE Commits (
         BookTitle varchar(200),
         CrimeID int, 
         CrimeName varchar(200),
         CharacterRoleID int, 
         CharacterRoleType varchar(200),
         PRIMARY KEY (BookTitle, CrimeID, CharacterRoleID)
         );
         
DROP TABLE IF EXISTS Plays;
CREATE TABLE Plays (
         CharacterID int, 
         CharacterRoleID int,
         PRIMARY KEY (CharacterRoleID, CharacterID)
         );

DROP TABLE IF EXISTS Solves;
CREATE TABLE Solves (
         DetectiveName varchar(200), 
         CrimeID int,
         CrimeName varchar(200),
         PRIMARY KEY (DetectiveName, CrimeID)
         );



