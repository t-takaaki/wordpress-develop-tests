<<<<<<< .mine
<?php 

/**
 * @group user
 */
class Tests_User_WpSetCurrentUser extends WP_UnitTestCase {
	
	public function test_set_by_id() {
		$u = $this->factory->user->create();

		$user = wp_set_current_user( $u );

		$this->assertSame( $u, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( $u, get_current_user_id() );
	}

	public function test_name_should_be_ignored_if_id_is_not_null() {
		$u = $this->factory->user->create();

		$user = wp_set_current_user( $u, 'foo' );

		$this->assertSame( $u, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( $u, get_current_user_id() );
	}

	public function test_should_set_by_name_if_id_is_null_and_current_user_is_nonempty() {
		$u1 = $this->factory->user->create();
		wp_set_current_user( $u1 );
		$this->assertSame( $u1, get_current_user_id() );

		$u2 = $this->factory->user->create( array(
			'user_login' => 'foo',
		) );

		$user = wp_set_current_user( null, 'foo' );
		bw_trace2( $user, "user", false );

		$this->assertSame( $u2, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( $u2, get_current_user_id() );
	}

	/**
	 * Test that you can set the current user by the name parameter when the current user is 0.
	 *
	 * @ticket 20845
	 */
	public function test_should_set_by_name_if_id_is_null() {
		wp_set_current_user( 0 );
		$this->assertSame( 0, get_current_user_id() );

		$u = $this->factory->user->create( array(
			'user_login' => 'foo',
		) );

		$user = wp_set_current_user( null, 'foo' );

		$this->assertSame( $u, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( $u, get_current_user_id() );
	}
}

	


=======
<?php

/**
 * @group user
 */
class Tests_User_WpSetCurrentUser extends WP_UnitTestCase {
	protected static $user_id;
	protected static $user_id2;
	protected static $user_ids = array();

	public static function wpSetUpBeforeClass( $factory ) {
		self::$user_ids[] = self::$user_id = $factory->user->create();
		self::$user_ids[] = self::$user_id2 = $factory->user->create( array( 'user_login' => 'foo', ) );
	}

	public static function wpTearDownAfterClass() {
		foreach ( self::$user_ids as $id ) {
			self::delete_user( $id );
		}
	}

	public function test_set_by_id() {
		$user = wp_set_current_user( self::$user_id );

		$this->assertSame( self::$user_id, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( self::$user_id, get_current_user_id() );
	}

	public function test_name_should_be_ignored_if_id_is_not_null() {
		$user = wp_set_current_user( self::$user_id, 'foo' );

		$this->assertSame( self::$user_id, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( self::$user_id, get_current_user_id() );
	}

	public function test_should_set_by_name_if_id_is_null_and_current_user_is_nonempty() {
		wp_set_current_user( self::$user_id );
		$this->assertSame( self::$user_id, get_current_user_id() );

		$user = wp_set_current_user( null, 'foo' );

		$this->assertSame( self::$user_id2, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( self::$user_id2, get_current_user_id() );
	}

	/**
	 * Test that you can set the current user by the name parameter when the current user is 0.
	 *
	 * @ticket 20845
	 */
	public function test_should_set_by_name_if_id_is_null() {
		wp_set_current_user( 0 );
		$this->assertSame( 0, get_current_user_id() );

		$user = wp_set_current_user( null, 'foo' );

		$this->assertSame( self::$user_id2, $user->ID );
		$this->assertEquals( $user, wp_get_current_user() );
		$this->assertSame( self::$user_id2, get_current_user_id() );
	}
}

>>>>>>> .r35263
