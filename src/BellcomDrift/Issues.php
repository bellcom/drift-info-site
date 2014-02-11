<?php

namespace BellcomDrift;

class Issues
{
  protected $app;

  /**
   * __construct
   * @return void
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  public function __construct( \Klein\App $app )
  {
    $this->app = $app;
  }

  /**
   * getResolved
   * @param int $limit
   * @return mixed
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  public function getResolved( $limit = 0 )
  {
    $resolved = false;

    $sql = "SELECT * FROM issues WHERE resolved = 1 ORDER BY date DESC";

    if ( $limit !== 0 )
    {
      $sql .= " LIMIT $limit";
    }

    $resolved = $this->query($sql);

    return $resolved;
  }

  /**
   * getResolved
   * @param int $limit
   * @return mixed
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  public function getUnResolved( $limit = 0 )
  {
    $unresolved = false;

    $sql = "SELECT * FROM issues WHERE resolved = 0 ORDER BY date DESC";

    if ( $limit !== 0 )
    {
      $sql .= " LIMIT $limit";
    }

    $unresolved = $this->query( $sql );

    return $unresolved;
  }

  /**
   * delete
   * @param int $id
   * @return void
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  public function delete( $id )
  {
    $this->app->db->delete('issues', array('id' => $id));
  }

  /**
   * create
   * @param array $fields
   * @return void
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  public function create( $fields )
  {
    $fields['desc'] = '<p>'.$fields['desc'].'</p>';

    $timestamp = time();

    $this->app->db->insert('issues', array('title' => $fields['title'], 'desc' => $fields['desc'], 'author' => 'drift', 'date' => $timestamp));
  }

  /**
   * update
   * @param int $id
   * @param array $fields
   * @return void
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  public function update( $id, $fields )
  {
    if ( isset($fields['existing-desc']) )
    {
      $fields['desc'] = $fields['desc'].'<p>'.$fields['existing-desc'].'</p>';
    }

    $this->app->db->update('issues', array( 'resolved' => $fields['resolved'], 'desc' => $fields['desc']), array('id' => $id));
  }

  /**
   * query
   * @return void
   * @author Henrik Farre <hf@bellcom.dk>
   **/
  protected function query( $sql )
  {
    $result = false;

    try
    {
      $result = $this->app->db->query($sql);
    }
    catch (Doctrine\DBAL\Exception\TableNotFoundException $e)
    {
      error_log(__LINE__.':'.__FILE__.' '.$e->getMessage()); // hf@bellcom.dk debugging
    }
    catch (Doctrine\DBAL\Driver\PDOException $e)
    {
      error_log(__LINE__.':'.__FILE__.' '.$e->getMessage()); // hf@bellcom.dk debugging
    }
    catch (Exception $e)
    {
      error_log(__LINE__.':'.__FILE__.' '.$e->getMessage()); // hf@bellcom.dk debugging
    }

    return $result;
  }

}
