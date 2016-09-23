delimiter $$
use council$$

drop procedure if exists Post_Search$$
create procedure Post_Search(in searchTerms varchar(8000), in weight varchar(32))
begin
	drop table if exists searchTerm;
	create temporary table searchTerm(term varchar(64));

	call sp_split(searchTerms,'searchTerm');

    select count(*) from searchTerm into @n;
    set @i=1;

    select min(variable) from tmpSplit into @lastTerm;
    set @sql = concat('create temporary table scoreboard as (select ID,Title,Content,(((length(Title) - length(replace(lower(Title),lower("',@lastTerm,'"),""))) / (length("',@lastTerm,'") * (1 / ',weight,'))) + ((length(Content) - length(replace(lower(Content),lower("',@lastTerm,'"),""))) / length("',@lastTerm,'"))');
    while @i<@n do
        select min(variable) from tmpSplit where variable > @lastTerm into @lastTerm;
        set @sql := concat(@sql,' + ((length(Title) - length(replace(lower(Title),lower("',@lastTerm,'"),""))) / (length("',@lastTerm,'") * (1 / ',weight,'))) + ((length(Content) - length(replace(lower(Content),lower("',@lastTerm,'"),""))) / length("',@lastTerm,'"))');
        set @i=@i+1;
    end while;
select @sql;
    set @sql := concat(@sql,') as score from Posts order by score desc);');

    drop table if exists scoreboard;

    prepare stmt from @sql;
    execute stmt;
    deallocate prepare stmt;

end$$

delimiter ;
