import styled from "styled-components";
import React from "react";

const TodoListInputWrapper = styled.div`
  margin-bottom: 30px;
`;

const InputFunctions = styled.input`
  width: 300px;
  padding: 5px;
  border: 0px;
`;
const InputButton = styled.button`
  color: #8c495e;
  background: #d1d1c2;
  margin-left: 20px;
  cursor: pointer;
`;

function TodoListInputFunction({
  value,
  handleButtonClick,
  handleInputChange,
}) {
  return (
    <TodoListInputWrapper>
      <InputFunctions
        placeholder="嘿嘿！有什麼要我幫忙記的嗎？"
        value={value}
        onChange={handleInputChange}
      />
      <InputButton onClick={() => handleButtonClick()}>按我！</InputButton>
    </TodoListInputWrapper>
  );
}

export default TodoListInputFunction;
