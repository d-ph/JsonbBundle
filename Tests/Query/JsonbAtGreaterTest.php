<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 14.04.15
 * Time: 14:11
 */

namespace Boldtrn\JsonbBundle\Tests\Query;


use Boldtrn\JsonbBundle\Tests\BaseTest;

class JsonbAtGreaterTest extends BaseTest
{

    public function testContains()
    {
        $q = $this
            ->entityManager
            ->createQuery(
                "
        SELECT t
        FROM E:Test t
        WHERE JSONB_AG(t.attrs, 'value') = TRUE
        "
            );

        $expectedSQL = "SELECT t0_.id AS id0, t0_.attrs AS attrs1 FROM Test t0_ WHERE (t0_.attrs @> 'value') = true";

        $expectedSQL = str_replace("_", "", $expectedSQL);

        $actualSQL =  str_replace("_", "", $q->getSql());

        $this->assertEquals(
            $expectedSQL,
            $actualSQL
        );
    }

}
