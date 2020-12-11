import { useState, useContext } from "react";
import { useHistory } from "react-router-dom";
import { login, getMe } from "../../WebAPI";
import styled from "styled-components";
import { setAuthToken } from "../../utils";
import { AuthContext } from "../../contexts";

const ErrorMessage = styled.div`
  color: red;
`;
const LoginPageWrapper = styled.div`
  text-align: center;
  margin: 100px;
`;

export default function LoginPage() {
  const { setUser } = useContext(AuthContext);
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [errorMessage, setErrorMessage] = useState();
  const history = useHistory();

  const handleSubmit = () => {
    setErrorMessage(null);
    login(username, password).then((data) => {
      if (data.ok === 0) {
        return setErrorMessage(data.message);
      }
      setAuthToken(data.token);

      getMe().then((response) => {
        if (response.ok !== 1) {
          setAuthToken(null); // 有出錯，要順便把 token 清空
          return setErrorMessage(response.toString());
        }
        setUser(response.data);
        history.push("/");
      });
    });
  };

  return (
    <LoginPageWrapper>
      <form onSubmit={handleSubmit}>
        <div>
          username:
          <input
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
        </div>
        <div>
          password:
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </div>
        <button>登入</button>
        {errorMessage && <ErrorMessage>{errorMessage}</ErrorMessage>}
      </form>
    </LoginPageWrapper>
  );
}
