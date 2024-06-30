<?php
/**
 * Knights Move.
 * Chess!
 * Statement: https://github.com/jmatah/KnightsTour.git
 * A knight's tour is a sequence of moves of a knight on a chessboard such that the knight visits every square exactly once.
 *
 * @package KnoghtsTour
 * @version 1.0.0
 * @author Jatin Matah @ https://jatin.dev
 * @license GPL
 * @demo http://www.m-solutions.co.in/chess/
 */


/**
 * Class Knights_Tour
 *
 * @since 1.0.0
 */
class Knights_Tour {
	/**
	 * Keeping Track on what is available.
	 *
	 * @var array
	 */
	private $avail = array();

	/**
	 * Constructor Of Knight Tour.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/*
		 * Each Players info is saved on a flat file.
		 */
		$ip = $_SERVER['REMOTE_ADDR'];
		if ( strlen( $ip ) < 8 ) {
			$ip = '127.0.0.1';
		}

		$ip = str_replace( '.', '', $ip );
		define( '_CHESS_FILE', dirname( __FILE__ ) . '/done-' . $ip . '.txt' );

		// Create an array of availables.
		foreach ( range( 1, 8 ) as $c ) {
			foreach ( range( 1, 8 ) as $s ) {
				$this->avail[ $c . '' . $s ] = 1;
			}
		}

		// Overwrite the above with boxes already travelled; available="0".
		$done = @file( _CHESS_FILE );
		if ( ! empty( $done ) ) {
			foreach ( $done as $d ) {
				$this->avail[ trim( $d ) ] = 0;
			}
		} else {
			// file not found, create one;;
			file_put_contents( _CHESS_FILE, '11' );
			$this->avail[11] = 0;
		}

		// Is this ajax call or a printboard call.
		if ( empty( $_POST ) ) {
			$this->deleteOldFiles();

			// Delete flat file to start afresh.
			file_put_contents( _CHESS_FILE, '11' );
			$this->printBaord();
		} else {
			$this->printNextMove();
		}
	}

	// Just uncomment to delete old txt files.
	private function deleteOldFiles() {
		$path = dirname( __FILE__ );
		if ( $handle = opendir( $path ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( strpos( $file, 'done' ) !== false && strpos( $file, '.txt' ) !== false ) {
					if ( filemtime( $file ) < ( time() - ( 5 * 60 ) ) ) {
						unlink( $file );
					}
				}
			}
			closedir( $handle );
		}
	}

	/**
	 * Print Dashboard.
	 *
	 * @since 1.0.0
	 */
	private function printBaord() {
		require_once dirname( __FILE__ ) . '/board.php';
	}

	/**
	 * Write File.
	 *
	 * @since 1.0.0
	 *
	 * @param array $done Array of done spaces.
	 */
	private function writeFile( $done = array() ) {
		$done2 = array();
		foreach ( $done as $d ) {
			$d = trim( $d );
			if ( ! empty( $d ) ) {
				$done2[] = $d;
			}
		}
		$done = $done2;
		unset( $done2 );
		file_put_contents( _CHESS_FILE, implode( "\n", $done ) );

		return true;
	}

	/**
	 * Print Next Move.
	 *
	 * @since 1.0.0
	 */
	private function printNextMove() {
		$prevX = (int) trim( strip_tags( stripslashes( $_POST['prevx'] ) ) );
		$prevY = (int) trim( strip_tags( stripslashes( $_POST['prevy'] ) ) );

		// new logic: go away from the open.
		$moves = array(
			array( -2, -1 ),
			array( -1, -2 ),
			array( 1, -2 ),
			array( 2, -1 ),
			array( 2, 1 ),
			array( 1, 2 ),
			array( -1, 2 ),
			array( -2, 1 ),
		);

		$done = @file( _CHESS_FILE );

		if ( count( $done ) == 64 ) {
			header( 'Content-Type: Application/json' );
			echo json_encode(
				array(
					'next' => '',
					'msg'  => 'done',
				)
			);
			exit;
		}

		$possibility = array();
		foreach ( $moves as $i => $move ) {
			$a = $prevX + $move[0];
			$b = $prevY + $move[1];
			$c = $a . '' . $b;

			if ( isset( $this->avail[ $c ] ) && $this->avail[ $c ] == 1 ) {
				$possibility[ $c ] = 0;

				foreach ( $moves as $i => $move ) {
					$aa = $a + $move[0];
					$bb = $b + $move[1];
					$cc = $aa . '' . $bb;

					if ( isset( $this->avail[ $cc ] ) && $this->avail[ $cc ] == 1 ) {
						$possibility[ $c ]++;
					}
				}
			}
		}

		arsort( $possibility );

		$possibility  = array_flip( $possibility );
		$possibility2 = $possibility;

		// get square with least possible move;; sort and pop;
		if ( ! empty( $possibility ) ) {
			$new = array_pop( $possibility );
		}

		if ( empty( $new ) ) {
			header( 'Content-Type: Application/json' );
			echo json_encode(
				array(
					'next' => '',
					'msg'  => 'stale',
					'v'    => '<pre>' . print_r(
						$possibility2,
						true
					) . ';;' . $new,
				)
			);
			exit;
		}

		// verbose
		$v = '<br/>chknext: ' . $new . ';<br/>is avail: ' . $this->avail[ $new ] .
			';<br/>PrevX: ' . $_POST['prevx'] . ';<br/>PrevY: ' . $_POST['prevy'] . '<br><pre>' . print_r( $possibility2, true ) . '</pre>';

		// add current move and write to file //
		$done[] = $new;
		$this->writeFile( $done );

		header( 'Content-Type: Application/json' );
		echo json_encode(
			array(
				'next' => (string) $new,
				'msg'  => 'next',
				'v'    => $v,
			)
		);
		exit;
	}
}
$knights_tour = new Knights_Tour();
