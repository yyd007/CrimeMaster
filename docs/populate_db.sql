SET SQL_SAFE_UPDATES = 0;

DELETE FROM Books;
LOAD DATA
   LOCAL INFILE "/data/Books.txt"
   REPLACE INTO TABLE Books
   FIELDS TERMINATED BY '|'
   (BookTitle, AuthorName, Languages, Length, Country);


DELETE FROM Series;
LOAD DATA
    LOCAL INFILE "Series.txt"
    REPLACE INTO TABLE Series
    FIELDS TERMINATED BY '|'
    (SeriesName, AuthorName, LeadingCharacter);
 
DELETE FROM Authors;
LOAD DATA
    LOCAL INFILE "Authors.txt"
    REPLACE INTO TABLE Authors
    FIELDS TERMINATED BY '|'
    (AuthorName, Gender, Nationality);

DELETE FROM Characters;   
LOAD DATA
    LOCAL INFILE "Characters.txt"
    REPLACE INTO TABLE Characters
    FIELDS TERMINATED BY '|'
    (CharacterName, CharacterID, Gender, Nationality);

DELETE FROM CharacterRole;    
LOAD DATA
    LOCAL INFILE "CharacterRole.txt"
    REPLACE INTO TABLE CharacterRole
    FIELDS TERMINATED BY '|'
    (CharacterRoleType, CharacterRoleID);

DELETE FROM Crime;
LOAD DATA
    LOCAL INFILE "Crime.txt"
    REPLACE INTO TABLE Crime
    FIELDS TERMINATED BY '|'
    (CrimeName, CrimeID, motive);

DELETE FROM Detective;   
LOAD DATA
    LOCAL INFILE "Detective.txt"
    REPLACE INTO TABLE Detective
    FIELDS TERMINATED BY '|'
    (DetectiveName, OrganizationName, Gender, Nationality);



DELETE FROM Subgenre;   
LOAD DATA
    LOCAL INFILE "Subgenre.txt"
    REPLACE INTO TABLE Subgenre
    FIELDS TERMINATED BY '|'
    (GenreName, TimeofPopularity);


DELETE FROM BelongTo;
LOAD DATA
    LOCAL INFILE "BelongTo.txt"
    REPLACE INTO TABLE BelongTo
    FIELDS TERMINATED BY '|'
    (BookTitle, GenreName);


DELETE FROM IsIn;   
LOAD DATA
    LOCAL INFILE "IsIn.txt"
    REPLACE INTO TABLE IsIn
    FIELDS TERMINATED BY '|'
    (BookTitle, SeriesName);

-- DELETE FROM Contain;
-- LOAD DATA
--     LOCAL INFILE "Contain.txt"
--     REPLACE INTO TABLE Contain
--     FIELDS TERMINATED BY '|'
--     (BookTitle, DetectiveName);

DELETE FROM Writes;  
LOAD DATA
    LOCAL INFILE "Writes.txt"
    REPLACE INTO TABLE Writes
    FIELDS TERMINATED BY '|'
    (BookTitle, AuthorName);

DELETE FROM Has;
LOAD DATA
    LOCAL INFILE "Has.txt"
    REPLACE INTO TABLE Has
    FIELDS TERMINATED BY '|'
    (BookTitle，CharacterID, CharacterRoleID);

DELETE FROM Creates;   
LOAD DATA
    LOCAL INFILE "Creates.txt"
    REPLACE INTO TABLE Creates
    FIELDS TERMINATED BY '|'
    (AuthorName,CharacterID);

DELETE FROM Commits;
LOAD DATA
    LOCAL INFILE "Commits.txt"
    REPLACE INTO TABLE Commits
    FIELDS TERMINATED BY '|'
    (CharacterRoleID,CharacterRoleType,CrimeID,CrimeName);

DELETE FROM Solves;    
LOAD DATA
    LOCAL INFILE "Solves.txt"
    REPLACE INTO TABLE Solves
    FIELDS TERMINATED BY '|'
    (DetectiveName, CrimeID, CrimeName);

DELETE FROM Plays;    
LOAD DATA
    LOCAL INFILE "Plays.txt"
    REPLACE INTO TABLE Plays
    FIELDS TERMINATED BY '|'
    (CharacterID, CharacterRoleID);


        


         
