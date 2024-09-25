# Build a PHP MVC Framework From Scratch

## I. Environment required

- PHP 8.3.6

## II. Design pattern

### 1. Front Controller Pattern

- Mô tả: Mẫu này quản lý tất cả các yêu cầu HTTP thông qua một điểm vào duy nhất. Sử dụng file index.php làm điểm vào chính cho tất cả các request, sau đó truyền yêu cầu cho router để quyết định controller nào sẽ xử lý.
- Lợi ích: Dễ dàng quản lý tất cả các yêu cầu tại một nơi, từ đó có thể thực hiện các xử lý chung như logging, kiểm tra quyền truy cập.

### 2. Model-View-Controller (MVC) Pattern

- Mô tả: Đây là design pattern cốt lõi của, phân chia ứng dụng thành ba phần: Model (tương tác với database), View (hiển thị giao diện), và Controller (xử lý logic nghiệp vụ và điều hướng giữa Model và View).
- Lợi ích: Giúp phân tách logic xử lý, quản lý và hiển thị, dễ bảo trì và mở rộng ứng dụng.

### 3. Repository Pattern

- Mô tả: Giúp tách biệt logic truy xuất dữ liệu từ database với phần logic nghiệp vụ. Sử dụng Repository cho việc truy xuất dữ liệu một cách linh hoạt.
- Lợi ích: Giúp tái sử dụng code, thay đổi cách tương tác với database mà không ảnh hưởng đến business logic.
- Ví dụ:
  ```javascript
  class UserRepository {
  	public function find($id) {
  		return User::find($id);
  	}
  }
  ```

### 4. Service Container / Dependency Injection Pattern

- Mô tả: sử dụng Service Container để quản lý các dependencies và thực hiện dependency injection. Bạn có thể xây dựng một Service Container để quản lý việc tạo ra các đối tượng và inject chúng vào các class khác.
- Lợi ích: Giúp giảm sự phụ thuộc giữa các class, dễ dàng quản lý và thay đổi dependencies.
- Ví dụ:
  ```javascript
  class ServiceContainer {
  	protected $bindings = [];
  	public function bind($name, $resolver) {
  		$this->bindings[$name] = $resolver;
  	}
  	public function make($name) {
  		return $this->bindings[$name]();
  	}
  }
  ```

### 5. Observer Pattern

- Mô tả: hệ thống events và observers để lắng nghe và phản hồi khi một sự kiện cụ thể xảy ra. Observer pattern giúp bạn theo dõi các thay đổi trong các đối tượng mà không ảnh hưởng đến chúng.
- Lợi ích: Tăng tính linh hoạt, dễ dàng mở rộng ứng dụng mà không cần thay đổi nhiều trong code chính.
- Ví dụ:
  ```javascript
  class UserObserver {
  	public function created(User $user) {
  		// Do something when a user is created
  	}
  }
  ```

### 6. Singleton Pattern

- Mô tả: Mẫu Singleton đảm bảo rằng một class chỉ có duy nhất một instance và cung cấp điểm truy cập toàn cục đến instance đó. Sử dụng Singleton cho nhiều dịch vụ, như Service Container, Config, v.v.
- Lợi ích: Tiết kiệm tài nguyên, đảm bảo tính nhất quán của đối tượng.
- Ví dụ:
  ```javascript
  class Config {
  	private static $instance = null;
  	private $settings = [];
  	private function __construct() {}
  	public static function getInstance() {
  		if (self::$instance == null) {
  			self::$instance = new Config();
  		}
  		return self::$instance;
  	}
  }
  ```

### 7. Strategy Pattern

- Mô tả: Strategy pattern cho phép thay đổi thuật toán hoặc hành vi của một đối tượng một cách linh hoạt. Ap dụng pattern này trong nhiều thành phần như authentication, cache, v.v.
- Lợi ích: Tăng tính linh hoạt, dễ mở rộng và bảo trì code.
- Ví dụ:

  ```javascript
  interface CacheStrategy {
  	public function store($key, $value);
  }

  class FileCache implements CacheStrategy {
  	public function store($key, $value) {
  		// store cache in file
  	}
  }

  class RedisCache implements CacheStrategy {
  	public function store($key, $value) {
  		// store cache in redis
  	}
  }
  ```

### 8. Factory Pattern

- Mô tả: Factory pattern được sử dụng để tạo các object mà không cần chỉ định trực tiếp lớp cụ thể của chúng. Ap dụng điều này khi tạo ra các dịch vụ hoặc các class thông qua Service Container.
- Lợi ích: Tăng khả năng mở rộng, dễ quản lý và thay đổi các loại đối tượng được tạo ra.
- Ví dụ:

  ```javascript
  class UserFactory {
  	public static function create($type) {
  		if ($type === 'admin') {
  			return new AdminUser();
  		} else {
  			return new RegularUser();
  		}
  	}
  }
  ```

=> Tổng kết

- Front Controller và MVC là các pattern cơ bản để quản lý luồng xử lý request và chia nhỏ logic ứng dụng.
- Repository và Service Container giúp quản lý dữ liệu và dependency dễ dàng.
  Observer, Singleton, Strategy, và Factory giúp tăng tính linh hoạt và mở rộng cho ứng dụng.
