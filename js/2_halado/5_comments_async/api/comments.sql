create schema if not exists info3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
use info2;

drop table if exists comments;

create table comments
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    author  VARCHAR(50),
    comment TEXT,
    upvotes INT DEFAULT 0
);

insert into comments (id, author, comment, upvotes) values (1, 'John Doe', 'Nice article, thanks!', 5);
insert into comments (id, author, comment, upvotes) values (2, 'Jane Doe', 'More or less I agree.', 1);
insert into comments (id, author, comment, upvotes) values (3, 'Bill Gates', 'Good to know!', 3);
