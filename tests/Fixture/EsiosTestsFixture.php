<?php

namespace Esios\Tests\Fixture;

class EsiosTestsFixture {

    /**
     * /indicators/1013
     * start_date: 2017-03-01, end_date: 2017-03-02 
     * @return string
     */
    public static function getResponse1013() {

        return '{"indicator":{"name":"Término de facturación de energía activa del PVPC peaje por defecto","short_name":"PVPC T. Defecto","id":1013,"composited":false,"step_type":"linear","disaggregated":false,"magnitud":[{"name":"Precio","id":23}],"tiempo":[{"name":"Hora","id":4}],"geos":[{"geo_id":3,"geo_name":"España"}],"values_updated_at":"2017-03-01T21:01:30.000+01:00","values":[{"value":116.62,"datetime":"2017-03-01T00:00:00.000+01:00","datetime_utc":"2017-02-28T23:00:00Z","tz_time":"2017-02-28T23:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":110.32,"datetime":"2017-03-01T01:00:00.000+01:00","datetime_utc":"2017-03-01T00:00:00Z","tz_time":"2017-03-01T00:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":108.17,"datetime":"2017-03-01T02:00:00.000+01:00","datetime_utc":"2017-03-01T01:00:00Z","tz_time":"2017-03-01T01:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":107.71,"datetime":"2017-03-01T03:00:00.000+01:00","datetime_utc":"2017-03-01T02:00:00Z","tz_time":"2017-03-01T02:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":107.73,"datetime":"2017-03-01T04:00:00.000+01:00","datetime_utc":"2017-03-01T03:00:00Z","tz_time":"2017-03-01T03:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":108.94,"datetime":"2017-03-01T05:00:00.000+01:00","datetime_utc":"2017-03-01T04:00:00Z","tz_time":"2017-03-01T04:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":119.5,"datetime":"2017-03-01T06:00:00.000+01:00","datetime_utc":"2017-03-01T05:00:00Z","tz_time":"2017-03-01T05:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":121.41,"datetime":"2017-03-01T07:00:00.000+01:00","datetime_utc":"2017-03-01T06:00:00Z","tz_time":"2017-03-01T06:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":119.35,"datetime":"2017-03-01T08:00:00.000+01:00","datetime_utc":"2017-03-01T07:00:00Z","tz_time":"2017-03-01T07:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":119.0,"datetime":"2017-03-01T09:00:00.000+01:00","datetime_utc":"2017-03-01T08:00:00Z","tz_time":"2017-03-01T08:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":118.97,"datetime":"2017-03-01T10:00:00.000+01:00","datetime_utc":"2017-03-01T09:00:00Z","tz_time":"2017-03-01T09:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":117.2,"datetime":"2017-03-01T11:00:00.000+01:00","datetime_utc":"2017-03-01T10:00:00Z","tz_time":"2017-03-01T10:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":113.84,"datetime":"2017-03-01T12:00:00.000+01:00","datetime_utc":"2017-03-01T11:00:00Z","tz_time":"2017-03-01T11:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":114.1,"datetime":"2017-03-01T13:00:00.000+01:00","datetime_utc":"2017-03-01T12:00:00Z","tz_time":"2017-03-01T12:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":113.76,"datetime":"2017-03-01T14:00:00.000+01:00","datetime_utc":"2017-03-01T13:00:00Z","tz_time":"2017-03-01T13:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":111.74,"datetime":"2017-03-01T15:00:00.000+01:00","datetime_utc":"2017-03-01T14:00:00Z","tz_time":"2017-03-01T14:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":107.47,"datetime":"2017-03-01T16:00:00.000+01:00","datetime_utc":"2017-03-01T15:00:00Z","tz_time":"2017-03-01T15:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":110.25,"datetime":"2017-03-01T17:00:00.000+01:00","datetime_utc":"2017-03-01T16:00:00Z","tz_time":"2017-03-01T16:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":116.76,"datetime":"2017-03-01T18:00:00.000+01:00","datetime_utc":"2017-03-01T17:00:00Z","tz_time":"2017-03-01T17:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":120.51,"datetime":"2017-03-01T19:00:00.000+01:00","datetime_utc":"2017-03-01T18:00:00Z","tz_time":"2017-03-01T18:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":121.13,"datetime":"2017-03-01T20:00:00.000+01:00","datetime_utc":"2017-03-01T19:00:00Z","tz_time":"2017-03-01T19:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":123.15,"datetime":"2017-03-01T21:00:00.000+01:00","datetime_utc":"2017-03-01T20:00:00Z","tz_time":"2017-03-01T20:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":121.9,"datetime":"2017-03-01T22:00:00.000+01:00","datetime_utc":"2017-03-01T21:00:00Z","tz_time":"2017-03-01T21:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":120.44,"datetime":"2017-03-01T23:00:00.000+01:00","datetime_utc":"2017-03-01T22:00:00Z","tz_time":"2017-03-01T22:00:00.000Z","geo_id":3,"geo_name":"España"},{"value":123.3,"datetime":"2017-03-02T00:00:00.000+01:00","datetime_utc":"2017-03-01T23:00:00Z","tz_time":"2017-03-01T23:00:00.000Z","geo_id":3,"geo_name":"España"}]}}';
    }

}