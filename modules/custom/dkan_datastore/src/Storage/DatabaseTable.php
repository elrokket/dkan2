<?php

namespace Drupal\dkan_datastore\Storage;

use Drupal\Core\Database\Connection;
use Dkan\Datastore\Resource;
use Drupal\dkan_common\Storage\AbstractDatabaseTable;

/**
 * Database storage object.
 *
 * @see \Dkan\Datastore\Storage\StorageInterface
 */
class DatabaseTable extends AbstractDatabaseTable implements \JsonSerializable {

  /**
   * Datastore resource object.
   *
   * @var \Dkan\Datastore\Resource
   */
  private $resource;

  /**
   * Constructor method.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   Drupal database connection object.
   * @param \Dkan\Datastore\Resource $resource
   *   A resource.
   */
  public function __construct(Connection $connection, Resource $resource) {
    // Set resource before calling the parent constructor. The parent calls
    // getTableName which we implement and needs the resource to operate.
    $this->resource = $resource;
    parent::__construct($connection);
  }

  /**
   * Get summary.
   */
  public function getSummary() {
    $columns = array_keys($this->getSchema()['fields']);
    $numOfColumns = count($columns);
    $numOfRows = $this->count();
    return new TableSummary($numOfColumns, $columns, $numOfRows);
  }

  /**
   * Inherited.
   *
   * {@inheritDoc}
   */
  public function jsonSerialize() {
    return (object) ['resource' => $this->resource];
  }

  /**
   * Hydrate.
   */
  public static function hydrate(string $json) {
    $data = json_decode($json);
    $resource = Resource::hydrate(json_encode($data->resource));

    return new DatabaseTable(\Drupal::service('database'), $resource);
  }

  /**
   * Get the full name of datastore db table.
   *
   * @return string
   *   Table name.
   */
  protected function getTableName() {
    if ($this->resource) {
      return "dkan_datastore_{$this->resource->getId()}";
    }
    return "dkan_datastore_does_not_exist";
  }

  /**
   * Protected.
   */
  protected function prepareData(string $data, string $id = NULL): array {
    return json_decode($data);
  }

  /**
   * Protected.
   */
  protected function primaryKey() {
    return "record_number";
  }

  /**
   * Protected.
   */
  protected function getNonSerialFields() {
    $fields = parent::getNonSerialFields();
    $index = array_search($this->primaryKey(), $fields);
    if ($index !== FALSE) {
      unset($fields[$index]);
    }
    return $fields;
  }

  /**
   * Overriden.
   */
  public function setSchema($schema) {
    $fields = $schema['fields'];
    $new_field = [
      $this->primaryKey() =>
      [
        'type' => 'serial',
        'unsigned' => TRUE,
        'not null' => TRUE,
      ],
    ];
    $fields = array_merge($new_field, $fields);

    $schema['fields'] = $fields;
    $schema['primary key'] = [$this->primaryKey()];
    parent::setSchema($schema);
  }

}
