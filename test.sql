CREATE TABLE products 
	(
     product_id int auto_increment primary key, 
     name varchar(20), 
     description varchar(30)
      
    );

INSERT INTO products
(name, description)
VALUES
('Rug', 'A cool rug'  ),
('Cup', 'A coffee cup');

create table variants (variant_id int auto_increment primary key,
                       variant varchar(50)
                       );
insert into variants (variant)
values ('color'),('material'),('size') ;   
create table variant_value(value_id int auto_increment primary key, 
                           variant_id int ,
                           value varchar(50)
                           );

insert into variant_value (variant_id,value)
values (1 ,'red'),(1 ,'blue'),(1 ,'green'),
        (2 ,'wool'),(2 ,'polyester'),
        (3 ,'small'),(3 ,'medium'),(3 ,'large');

        

create table product_Variants( product_Variants_id int  auto_increment primary key,
                            product_id int,
                            productVariantName varchar(50),
                            sku varchar(50),
                            price float
                            );




create table product_details(product_detail_id int auto_increment primary key,
                             product_Variants_id int,
                             
                             value_id int
                             );
                             
insert into product_Variants(product_id,productVariantName,sku,price)
values (1,'red-wool' ,'a121',50);

insert into product_details(product_Variants_id , value_id)
values( 1,1),(1,4);

insert into product_Variants(product_id,productVariantName,sku,price)
values (1,'red-polyester' ,'a122',50);

insert into product_details(product_Variants_id , value_id)
values( 2,1),(2,5);


-- chạy lệnh join
select * from products p inner join product_variants pv on p.product_id = pv.product_id 
inner join product_details pd on pd.product_Variants_id = pv.product_Variants_id
inner join variant_value vv on vv.value_id = pd.value_id
inner join variants v on v.variant_id = vv.variant_id