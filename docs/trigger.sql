-- ------------------------------------------------------------------------------
-- ------------------------------------------------------------------------------
-- ------------------------------------------------------------------------------
-- create tables to keep track of relation table changes
DROP TABLE IF EXISTS Relation_Log;
CREATE TABLE Relation_Log (
	SourceID VARCHAR(50),
	TargetID VARCHAR(50),
    Change_time DATETIME,
    User_name VARCHAR(50),
    update_type VARCHAR(50)
    -- PRIMARY KEY (Change_time, User_name)
);

DROP TABLE IF EXISTS Relation_Update_Log;
CREATE TABLE Relation_Update_Log (
	SourceID VARCHAR (50),
    TargetID VARCHAR (50),
	old_Relation_Source VARCHAR (50),
    new_Relation_Source VARCHAR (50),
    old_Relation_Type VARCHAR (50),
    new_Relation_Type VARCHAR (50),
    Change_time DATETIME,
    User_name VARCHAR(50)
    -- PRIMARY KEY (Change_time, User_name)
);

DROP TABLE IF EXISTS Relation_Delete_Log;
CREATE TABLE Relation_Delete_Log (
	SourceID VARCHAR (50),
    TargetID VARCHAR (50),
    Source_Type VARCHAR (50),
    Target_Type VARCHAR (50),
	Relation_Source VARCHAR (50),
    Relation_Type VARCHAR (50),
    Change_time DATETIME,
    User_name VARCHAR(50)
    -- PRIMARY KEY (Change_time, User_name)
);

DROP TABLE IF EXISTS Entity_Insertion_Log;
CREATE TABLE Entity_Insertion_Log (
	ID VARCHAR (50),
    Change_time DATETIME,
    User_name VARCHAR(50)
    -- PRIMARY KEY (Change_time, User_name)
);

DROP TABLE IF EXISTS Entity_Delete_Log;
CREATE TABLE Entity_Delete_Log (
	ID VARCHAR (50),
    Change_time DATETIME,
    User_name VARCHAR(50)
    -- PRIMARY KEY (Change_time, User_name)
);


DROP TABLE IF EXISTS Entity_Update_Log;
CREATE TABLE Entity_Update_Log (
	ID VARCHAR (50),
	old_Name VARCHAR (50),
    new_Name VARCHAR (50),
    old_Source VARCHAR (50),
    new_Source VARCHAR (50),
    old_URL VARCHAR (50),
    new_URL VARCHAR (50),
    Change_time DATETIME,
    User_name VARCHAR(50) 
    -- PRIMARY KEY (Change_time, User_name)
);
-- SELECT * FROM Relation_Update_Log;
-- SELECT * FROM Compound_Disease_relation WHERE SourceID ='DB00014' AND TargetID ='DOID:1612'
-- ;
-- UPDATE Compound_Disease_relation SET Relation_Source = 'AAA' 
-- WHERE SourceID ='DB00014' AND TargetID ='DOID:1612';


-- -------------------------------------------------------------------------------------------
-- -------------------------------------------------------------------------------------------
-- -------------------------------------------------------------------------------------------

-- Format Triggers: prevents insertion into anatomy if the anatomy ID is not formatted correctly (i.e. starts with UBERON)
-- and keep logs of successfully inserted anatomies
DROP TRIGGER IF EXISTS Anatomy_Format_Trigger;
DELIMITER |
CREATE Trigger Anatomy_Format_Trigger
AFTER INSERT ON Anatomy
FOR EACH ROW
BEGIN
	INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	IF NOT (NEW.ID LIKE 'UBERON%') THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Anatomy ID is formatted wrongly.';
	-- ELSE 
		-- INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	END IF;
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Disease_Format_Trigger;
DELIMITER |
CREATE Trigger Disease_Format_Trigger
AFTER INSERT ON Disease
FOR EACH ROW
BEGIN
	INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	IF NOT (NEW.ID LIKE 'DOID%') THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Disease ID is formatted wrongly.';
	-- ELSE 
		-- INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	END IF;
END; |
DELIMITER ;

-- DROP TRIGGER IF EXISTS Gene_Format_Trigger;
-- DELIMITER |
-- CREATE Trigger Gene_Format_Trigger
-- AFTER INSERT ON Gene
-- FOR EACH ROW
-- BEGIN
-- 	INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
-- 	IF NOT (NEW.ID+0=NEW.ID) THEN
-- 		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Gene ID is formatted wrongly.';
-- 	-- ELSE 
-- 		-- INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
-- 	END IF;
-- END; |
-- DELIMITER ;
-- 
DROP TRIGGER IF EXISTS Symptom_Format_Trigger;
DELIMITER |
CREATE Trigger Symptom_Format_Trigger
AFTER INSERT ON Symptom
FOR EACH ROW
BEGIN
	INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	IF NOT (NEW.ID LIKE '%D0%') THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Symptom ID is formatted wrongly.';
	-- ELSE 
		-- INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	END IF;
END; |
DELIMITER ;

SELECT * FROM Compound;
DROP TRIGGER IF EXISTS Compound_Format_Trigger;
DELIMITER |
CREATE Trigger Compound_Format_Trigger
AFTER INSERT ON Compound
FOR EACH ROW
BEGIN
	INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	IF NOT (NEW.ID LIKE '%DB%') THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Compound ID is formatted wrongly.';
	-- ELSE 
		-- INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	END IF;
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS SideEffect_Format_Trigger;
DELIMITER |
CREATE Trigger SideEffect_Format_Trigger
AFTER INSERT ON SideEffect
FOR EACH ROW
BEGIN
	INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	IF NOT (NEW.ID LIKE '%C00%') THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Side Effect ID is formatted wrongly.';
	-- ELSE 
		-- INSERT IGNORE INTO Entity_Insertion_Log VALUES (NEW.ID, NOW(),CURRENT_USER());
	END IF;
END; |
DELIMITER ;



-- -----------------------------------------------------------------------------
-- -----------------------------------------------------------------------------
-- -----------------------------------------------------------------------------

-- UPDATE Entity TRIGGERS
-- 1) ANATOMY
DROP TRIGGER IF EXISTS Anatomy_Update_Trigger;
DELIMITER |
CREATE Trigger Anatomy_Update_Trigger
BEFORE UPDATE ON Anatomy 
FOR EACH ROW
BEGIN 
	INSERT IGNORE INTO Entity_Update_Log VALUES (NEW.ID, OLD.Anatomy_Name, NEW.Anatomy_Name, OLD.Anatomy_Source, 
    NEW.Anatomy_Source, OLD.URL,NEW.URL,NOW(),CURRENT_USER());
END; |
DELIMITER ;

-- 2) Compound
DROP TRIGGER IF EXISTS Compound_Update_Trigger;
DELIMITER |
CREATE Trigger Compound_Update_Trigger
BEFORE UPDATE ON Compound 
FOR EACH ROW
BEGIN 
	INSERT IGNORE INTO Entity_Update_Log VALUES (NEW.ID, OLD.Compound_Name, NEW.Compound_Name, OLD.Compound_Source, 
    NEW.Compound_Source, OLD.URL,NEW.URL,NOW(),CURRENT_USER());
END; |
DELIMITER ;

-- 3) Disease
DROP TRIGGER IF EXISTS Disease_Update_Trigger;
DELIMITER |
CREATE Trigger Disease_Update_Trigger
BEFORE UPDATE ON Disease 
FOR EACH ROW
BEGIN 
	INSERT IGNORE INTO Entity_Update_Log VALUES (NEW.ID, OLD.Disease_Name, NEW.Disease_Name, OLD.Disease_Source, 
    NEW.Disease_Source, OLD.URL,NEW.URL,NOW(),CURRENT_USER());
END; |
DELIMITER ;

-- 4) Gene
DROP TRIGGER IF EXISTS Gene_Update_Trigger;
DELIMITER |
CREATE Trigger Gene_Update_Trigger
AFTER UPDATE ON Gene 
FOR EACH ROW
BEGIN 
	INSERT IGNORE INTO Entity_Update_Log VALUES (NEW.ID, OLD.Gene_Name, NEW.Gene_Name, OLD.Gene_Source, 
    NEW.Gene_Source, OLD.URL,NEW.URL,NOW(),CURRENT_USER());
END; |
DELIMITER ;

-- 5) Symptom
DROP TRIGGER IF EXISTS Symptom_Update_Trigger;
DELIMITER |
CREATE Trigger Symptom_Update_Trigger
BEFORE UPDATE ON Symptom 
FOR EACH ROW
BEGIN 
	INSERT IGNORE INTO Entity_Update_Log VALUES (NEW.ID, OLD.Symptom_Name, NEW.Symptom_Name, OLD.Symptom_Source, 
    NEW.Symptom_Source, OLD.URL,NEW.URL,NOW(),CURRENT_USER());
END; |
DELIMITER ;

-- 6) SideEffect
DROP TRIGGER IF EXISTS SideEffect_Update_Trigger;
DELIMITER |
CREATE Trigger SideEffect_Update_Trigger
BEFORE UPDATE ON SideEffect 
FOR EACH ROW
BEGIN 
	INSERT IGNORE INTO Entity_Update_Log VALUES (NEW.ID, OLD.SideEffect_Name, NEW.SideEffect_Name, OLD.SideEffect_Source, 
    NEW.SideEffect_Source, OLD.URL,NEW.URL,NOW(),CURRENT_USER());
END; |
DELIMITER ;



-- trigger 2: when inserting new relation into compound_disease relation table, 
-- check if the sourceID and  targetID are formatted correctly. If not, prevent the insertion from happening.
-- Otherwise, check if the two IDs are in the compound and disease table respectively. If not, add new entries to those tables.
-- If the insertion happens successfully, keep its log in Relation_Log
DROP TRIGGER IF EXISTS Compound_Disease_ExistsTrigger;
DELIMITER |
CREATE TRIGGER Compound_Disease_ExistsTrigger
AFTER INSERT ON Compound_Disease_relation
FOR EACH ROW	
	BEGIN		
		IF NEW.SourceID LIKE 'DB%' AND NEW.TargetID LIKE 'DOID%' THEN
			INSERT IGNORE INTO Compound(ID)	VALUES(NEW.SourceID);	
			INSERT IGNORE INTO Disease(ID) VALUES(NEW.TargetID);
			INSERT IGNORE INTO Relation_Log 
			VALUES(NEW.SourceID, New.TargetID, NOW(),CURRENT_USER(),'insertion');
		ELSE SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Either targetID or sourceID is formatted wrongly.';
		END IF;
END; |
DELIMITER ;

-- --------------------------------------------------------------------- 
-- ----------------------------------------------------------------------
-- ----------------------------------------------------------------------
-- ----------------------------------------------------------------------
-- UPDATE RELATION TRIGGERS
-- trigger3: when making update on Compound_Disease_relation table, if the sourceID and targetID of the update are correctly formatted, then make the update.
-- Otherwise, use the old sourceID/ targetID.
-- Also, register the update in the Relation_Log table. 
DROP TRIGGER IF EXISTS Compound_Disease_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Compound_Disease_UpdateTrigger
BEFORE UPDATE ON Compound_Disease_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Compound_SideEffect_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Compound_SideEffect_UpdateTrigger
BEFORE UPDATE ON Compound_SideEffect_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Compound_Gene_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Compound_Gene_UpdateTrigger
BEFORE UPDATE ON Compound_Gene_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Disease_Anatomy_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Disease_Anatomy_UpdateTrigger
BEFORE UPDATE ON Disease_Anatomy_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;


DROP TRIGGER IF EXISTS Disease_Gene_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Disease_Gene_UpdateTrigger
BEFORE UPDATE ON Disease_Gene_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;


DROP TRIGGER IF EXISTS Disease_Symptom_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Disease_Symptom_UpdateTrigger
BEFORE UPDATE ON Disease_Symptom_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Gene_Gene_UpdateTrigger;
DELIMITER |
CREATE TRIGGER Gene_Gene_UpdateTrigger
BEFORE UPDATE ON Gene_Gene_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Update_Log 
	VALUES(NEW.SourceID, New.TargetID, OLD.Relation_Source, NEW.Relation_Source, 
	OLD.Relation_Type, NEW.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;、

-- ------------------------------------------------------------------------------
-- ------------------------------------------------------------------------------
-- ------------------------------------------------------------------------------
-- RELATION DELETE TRIGGERS
DROP TRIGGER IF EXISTS Compound_Disease_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Compound_Disease_DeleteTrigger
BEFORE DELETE ON Compound_Disease_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Compound_Gene_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Compound_Gene_DeleteTrigger
BEFORE DELETE ON Compound_Gene_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Compound_SideEffect_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Compound_SideEffect_DeleteTrigger
BEFORE DELETE ON Compound_SideEffect_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Disease_Anatomy_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Disease_Anatomy_DeleteTrigger
BEFORE DELETE ON Disease_Anatomy_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Disease_Gene_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Disease_Gene_DeleteTrigger
BEFORE DELETE ON Disease_Gene_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Disease_Symptom_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Disease_Symptom_DeleteTrigger
BEFORE DELETE ON Disease_Symptom_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS Gene_Gene_DeleteTrigger;
DELIMITER |
CREATE TRIGGER Gene_Gene_DeleteTrigger
BEFORE DELETE ON Gene_Gene_relation
FOR EACH ROW	
	BEGIN		
	INSERT IGNORE INTO Relation_Delete_Log 
	VALUES(OLD.SourceID, OLD.TargetID, OLD.Source_Type, OLD.Target_Type, 
    OLD.Relation_Source, OLD.Relation_Type, NOW(),CURRENT_USER());
END; |
DELIMITER ;
