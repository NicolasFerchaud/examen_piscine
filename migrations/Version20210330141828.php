<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330141828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_product (order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4584665A ON media (product_id)');
        $this->addSql('ALTER TABLE opinion ADD product_id INT NOT NULL, ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B0274584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B0279395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_AB02B0274584665A ON opinion (product_id)');
        $this->addSql('CREATE INDEX IDX_AB02B0279395C3F3 ON opinion (customer_id)');
        $this->addSql('ALTER TABLE `order` ADD customer_id INT NOT NULL, ADD delivery_mode_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993987DFB3A94 FOREIGN KEY (delivery_mode_id) REFERENCES delivery_mode (id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON `order` (customer_id)');
        $this->addSql('CREATE INDEX IDX_F52993987DFB3A94 ON `order` (delivery_mode_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_product');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C4584665A');
        $this->addSql('DROP INDEX IDX_6A2CA10C4584665A ON media');
        $this->addSql('ALTER TABLE media DROP product_id');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B0274584665A');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B0279395C3F3');
        $this->addSql('DROP INDEX IDX_AB02B0274584665A ON opinion');
        $this->addSql('DROP INDEX IDX_AB02B0279395C3F3 ON opinion');
        $this->addSql('ALTER TABLE opinion DROP product_id, DROP customer_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993987DFB3A94');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3 ON `order`');
        $this->addSql('DROP INDEX IDX_F52993987DFB3A94 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP customer_id, DROP delivery_mode_id');
    }
}
